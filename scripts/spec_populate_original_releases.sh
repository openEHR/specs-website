#!/bin/bash
#
# Populate the site releases directory from original specifications /var/www/git/specifications
#

#
# ============== Definitions =============
#
git_root=/var/www/git/
old_specs_git_repo=specifications
old_specs_git_repo_clone_dir=$git_root$old_specs_git_repo
old_specs_git_repo_pub_dir=publishing
sites_root=/var/www/vhosts/openehr.org/

git_remove_local_changes="git clean -d -f"
git_fetch_cmd="git fetch --tags"
git_merge_cmd="git pull"
git_archive_cmd="git archive"
git_checkout_cmd="git --work-tree=work_area checkout -f"

release_dir=releases

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
# ============== Set up paths =============
#
site=${PWD#$sites_root}	# strip $sites_root from the front
site=${site%%/*}		# remove any trailing slash

echo "checking existence of $release_dir"
site_dir=$sites_root$site
cd $site_dir
if [ ! -d $release_dir ]; then
    mkdir $release_dir
    echo "created $release_dir in $site_dir"
fi

dest_parent_dir=$site_dir/$release_dir
echo "Target location: $dest_parent_dir"

#
# ============= get old specifcations Git repo up to date ============
#
cd $old_specs_git_repo_clone_dir
do_cmd "$git_remove_local_changes"
do_cmd "$git_fetch_cmd"
do_cmd "$git_merge_cmd"

#
# ============= Do the extraction from 'specifications' repo =============
# NOTE - 'specifications' is the old repo, and we now only rely on it for
# previous releases, not the development baseline.
#
# Here we cycle through all the git tags of the form "Release-*" in the repo
# and perform the 'git archive' command to extract the bit we want ('publishing' dir)
# and after extracted, rename it to the numerical part of the release
#

echo "------ exporting $old_specs_git_repo Git repo to site $site"
git tag | grep Release | while read tagname; do

    # convert tagname like "Release-0.9" into targ dir name like "0.9"
    tag_version=${tagname#Release-}

    # don't bother if it is already there
    targ_dir=$dest_parent_dir/$tag_version
    if [ ! -d $targ_dir ]; then
        do_cmd "$git_archive_cmd $tagname $old_specs_git_repo_pub_dir | tar -x -C $dest_parent_dir"

        # now rename the output dir to its release tag name
        do_cmd "mv $dest_parent_dir/$old_specs_git_repo_pub_dir $targ_dir"
    else
        echo "$targ_dir already extracted"
    fi
done

