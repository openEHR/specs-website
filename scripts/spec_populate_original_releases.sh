#!/bin/bash
#
# Populate the releases directory from original specifications /data/repos/specifications
# Only populates releases not already there. To force repopulation, manually delete relevant directories.
#

#
# ============== Definitions =============
#
repos_root=/data/repos
releases_root=/data/releases

git_remove_local_changes="git clean -d -f"
git_fetch_cmd="git fetch --tags"
git_merge_cmd="git pull"
git_archive_cmd="git archive"
git_checkout_cmd="git --work-tree=work_area checkout -f"

old_specs_git_repo=specifications
old_specs_git_repo_clone_dir=$repos_root/$old_specs_git_repo
old_specs_git_repo_pub_dir=publishing

#
# ============== functions =============
#

# run a command in a standard way
# $1 = command string
do_cmd () {
    echo "------ Running: $1"
    eval $1 2>&1
}

#
# ============= get old specifcations Git repo up to date ============
#
cd $repos_root/$old_specs_git_repo
echo "Source dir: $PWD"
do_cmd "$git_remove_local_changes"
do_cmd "$git_fetch_cmd"
do_cmd "$git_merge_cmd"

# create directories if this is the first time
echo "Target dir: $releases_root"
if [ ! -d $releases_root ]; then
	mkdir -pv $releases_root
fi

#
# ============= Do the extraction from 'specifications' repo =============
# NOTE - 'specifications' is the old repo, and we now only rely on it for
# previous releases, not the development baseline.
#
# Here we cycle through all the git tags of the form "Release-*" in the repo
# and perform the 'git archive' command to extract the bit we want ('publishing' dir)
# and after extracted, rename it to the numerical part of the release
#

echo "------ exporting $old_specs_git_repo Git repo "
git tag | grep Release | while read tagname; do

    # convert tagname like "Release-0.9" into targ dir name like "0.9"
    tag_version=${tagname#Release-}

    # don't bother if it is already there
    targ_dir=$releases_root/$tag_version
    if [ ! -d $targ_dir ]; then
        do_cmd "$git_archive_cmd $tagname $old_specs_git_repo_pub_dir | tar -x -C $releases_root"

        # now rename the output dir to its release tag name
        do_cmd "mv $releases_root/$old_specs_git_repo_pub_dir $targ_dir"
    else
        echo "$targ_dir already extracted"
    fi
done

