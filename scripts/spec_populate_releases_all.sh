#!/bin/bash
#
# Populate the releases directory from /data/repos/specifications-XX component repos,
#

#
# ============== Definitions =============
#
ROOT_DIR="$(dirname "$(realpath "${BASH_SOURCE[0]}")")"
populate_releases=$ROOT_DIR/spec_populate_releases.sh
git_root=/data/repos/

#
# ============= Do the extraction from 'specifications-*' repos =============
#
cd $git_root
ls -d specifications-* | while read git_component_repo; do
	$populate_releases $git_component_repo
done

