#!/bin/bash
#
# Populate the releases directory from /var/www/git/specifications-XX component repos,
#

#
# ============== Definitions =============
#
populate_releases=$PWD/spec_populate_releases.sh
git_root=/var/www/git/

#
# ============= Do the extraction from 'specifications-*' repos =============
#
cd $git_root
ls -d specifications-* | while read git_component_repo; do
	$populate_releases $git_component_repo
done

