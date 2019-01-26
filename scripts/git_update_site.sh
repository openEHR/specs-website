#!/bin/bash
#
# Populate directory $sites_root/$1 from /var/www/git/$1 repo
#

#
# ============== Definitions =============
USAGE="Usage: ${0} -v repo_name
  -v : turn on verbose mode
"

git_root=/var/www/git/
sites_root=/var/www/vhosts/openehr.org/

git_remove_local_changes="git clean -d -f"
git_fetch_cmd="git fetch --tags"
git_merge_cmd="git pull"
git_checkout_cmd="git --work-tree=work_area checkout -f"
git_status_cmd="git status"
chmod_cmd="chmod ug+x work_area/scripts/*.sh"

#
# ============== functions =============
#

# run a command in a standard way
# $1 = command string
do_cmd () {
	if [ -n $verbose_mode ]; then echo "------ Running: $1"; fi
    eval $1 2>&1
}


# =========== process command line ===========
# get the options
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

# make sure $1 exists
if [[ -n $1 ]]; then
	git_repo=$1
else
	echo "Missing argument; $USAGE"
	exit 1
fi

repo_dir=$sites_root$git_repo

#
# ============= Do the extraction from repo =============
#
cd $git_root$git_repo

echo 
echo "================ Updating $repo_dir from $PWD ================"

# get git repo in /var/www/git up to date
do_cmd "$git_remove_local_changes"
do_cmd "$git_fetch_cmd"
do_cmd "$git_merge_cmd"

# do checkout from git repo to /var/www/vhosts/openehr.org/xxx site area
do_cmd "${git_checkout_cmd/work_area/$repo_dir}"
do_cmd "$git_status_cmd"

# The following is a hack to fix the git problem whereby perms are changed on checkout
# For repos containing a scripts subdirectory, any .sh files there are made executable
do_cmd "${chmod_cmd/work_area/$repo_dir}"

