#!/bin/bash
#
# Populate the releases directory from /var/www/git/specifications-XX component repo
# specified in $1
# creating the following directory structure:
#	COMP
#	    canonical_release
#	    canonical_release
#

#
# ============== Definitions =============
USAGE="Usage: ${0} -v repo_name # matches 'specifications-*'
  -v : turn on verbose mode
"

#
git_root=/var/www/git/
sites_root=/var/www/vhosts/openehr.org/

git_remove_local_changes="git clean -d -f"
git_fetch_cmd="git fetch --tags"
git_merge_cmd="git pull"
git_archive_cmd="git archive"
git_checkout_cmd="git --work-tree=work_area checkout -f"

release_dir=releases
spec_component_dir_leader="specifications-"

# =========== process command line ===========
# ---------- get the options ----------
while getopts "v" o; do
    case "${o}" in
        v)
            verbose_mode=true
            ;;
        *)
            usage
            ;;
    esac
done
shift $((OPTIND-1))

# make sure $1 exists and is of the  form 'specifications-*'
if [[ -n $1 && -z ${1##$spec_component_dir_leader*} ]]; then
	git_component_repo=$1
else
	echo "Missing argument; $USAGE"
	exit 1
fi

#
# ============== functions =============
#

# run a command in a standard way
# $1 = command string
do_cmd () {
	if [ -n $verbose_mode ]; then echo "------ Running: $1"; fi
    eval $1 2>&1
}

#
# ============== Set up paths =============
#
site=${PWD#$sites_root}	# strip $sites_root from the front
site=${site%%/*}		# remove any trailing slash

echo "checking existence of $site_dir$release_dir"
site_dir=$sites_root$site
cd $site_dir
if [ ! -d $release_dir ]; then
    mkdir $release_dir
    echo "created $release_dir in $site_dir"
fi

dest_parent_dir=$site_dir/$release_dir
echo "Target location: $dest_parent_dir"

#
# ============= Do the extraction from repo =============
#
cd $git_root

component=${git_component_repo##$spec_component_dir_leader}
echo 
echo "================ Component: $component ================"

# get Git repo up to date
cd $git_component_repo
do_cmd "$git_remove_local_changes"
do_cmd "$git_fetch_cmd"
do_cmd "$git_merge_cmd"

# create any directories if this is the first time
site_component_dir=$dest_parent_dir/$component
if [ ! -d $site_component_dir ]; then
	mkdir $site_component_dir
	echo "created $site_component_dir"
fi

# do checkout of working baseline into 'latest'
work_area=$site_component_dir/latest
rm -rf $work_area
mkdir $work_area
echo "created $work_area"
do_cmd "${git_checkout_cmd/work_area/$work_area}"

# cycle through all releases and check out into release dirs
declare -A tagnames_table

while read tagname; do
	# figure out 'canonical' form of tag name by stripping off any trailing 'v.*' part
	canonical_tagname=${tagname%v*}

	# obtain the version id, which is a string representing an integer
	new_version_id=${tagname##*v}	# get the string of form 'v'<integer> or empty string
	if [[ "$new_version_id" == "$canonical_tagname" ]]; then
		new_version_id=0
	fi

	# if nothing set, just set the canonical tag name
	if [[ -z ${tagnames_table[$canonical_tagname]} ]]; then 
		tagnames_table[$canonical_tagname]=$tagname
	else
		# find out the version id of the existing highest release of this canonical key
		old_version_id=${tagnames_table[$canonical_tagname]##*v}	# get the string of form 'v'<integer> or empty string

		if [[ $old_version_id == ${tagnames_table[$canonical_tagname]} ]]; then
			old_version_id=0
		fi

		# if the new version is greater, replace the value in the Hash
		if [[ $new_version_id -gt $old_version_id ]] ; then
			tagnames_table[$canonical_tagname]=$tagname
		fi
	fi
done < <(git tag -l | grep "Release-")

# now process the release tags for this repo. Each key will be a canonical form 
# release id like "Release-1.0.5", and the value for that key will be either a 
# canonical tag name or a tag name of the form "Release-1.0.5v13", i.e. with "vN" on the end.
for release_name in "${!tagnames_table[@]}" ; do 
	release_tag=${tagnames_table[$release_name]}
	echo "For $release_name using $release_tag"

	# don't bother if it is already there
	targ_dir=$site_component_dir/$release_tag
	if [ -d $targ_dir ]; then
		echo "$targ_dir already extracted; nothing to do"
	else
		# first, delete any existing directories for this release
		do_cmd "rm -rf $site_component_dir/${release_name}*"

		# make a new directory with the concrete name of the release, which might be the canonical form
		echo "extracting $release_tag to $targ_dir"
		mkdir $targ_dir
		do_cmd "$git_archive_cmd $release_tag | tar -x -C $targ_dir"

		# if it is not the canonical form, we need to add a relative symlink with the canonical name
		canonical_targ_dir=$site_component_dir/$release_name
		if [ ! -d $canonical_targ_dir ]; then
			do_cmd "ln -sr $targ_dir $canonical_targ_dir"
		fi
	fi
done

