#!/bin/bash
#
# Populate the releases directory from /data/repos/specifications-XX component repo
# specified in $1
# creating the following directory structure:
#	COMPONENT
#	    canonical_release
#	    canonical_release
#

#
# ============== Definitions =============
#
USAGE="Usage: ${0} -v repo_name # matches 'specifications-*'
  -v : turn on verbose mode
"

repos_root=/data/repos
releases_root=/data/releases

git_remove_local_changes="git clean -d -f"
git_fetch_cmd="git fetch --tags"
git_merge_cmd="git pull"
git_archive_cmd="git archive"
git_checkout_cmd="git --work-tree=work_area checkout -f"

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
# ============= Do the extraction from repo =============
#
cd $repos_root

component=${git_component_repo##$spec_component_dir_leader}
echo 
echo "================ Component: $component ================"

# get Git repo up to date
cd $repos_root/$git_component_repo
echo "Source dir: $PWD"
do_cmd "$git_remove_local_changes"
do_cmd "$git_fetch_cmd"
do_cmd "$git_merge_cmd"

# create directories if this is the first time
component_dir=$releases_root/$component
echo "Target dir: $component_dir"
if [ ! -d $component_dir ]; then
	mkdir -pv $component_dir
fi

# do checkout of working baseline into 'development'
work_area=$component_dir/development
echo "Refreshing dir $work_area"
rm -rf $work_area
mkdir -p $work_area
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
	targ_dir=$component_dir/$release_tag
	if [ -d $targ_dir ]; then
		echo "$targ_dir already extracted; nothing to do"
	else
		# first, delete any existing directories for this release
		do_cmd "rm -rf $component_dir/${release_name}*"

		# make a new directory with the concrete name of the release, which might be the canonical form
		echo "extracting $release_tag to $targ_dir"
		mkdir -p $targ_dir
		do_cmd "$git_archive_cmd $release_tag | tar -x -C $targ_dir"

		# if it is not the canonical form, we need to add a relative symlink with the canonical name
		canonical_targ_dir=$component_dir/$release_name
		if [ ! -d $canonical_targ_dir ]; then
			do_cmd "ln -sr $targ_dir $canonical_targ_dir"
		fi
	fi
done

