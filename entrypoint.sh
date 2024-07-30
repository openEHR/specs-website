#!/bin/sh

if [ "$APP_SYSTEM" != "development" ]; then
  echo "entrypoint.sh: Installing PHP external libraries"
  composer install --no-dev --no-interaction --no-progress --no-ansi --classmap-authoritative
else
  echo "entrypoint.sh: Development mode detected - composer install has to be called manually, then run websites scripts to populate repos and releases"
fi

### notice: the following lines are disabled to make the container restart faster;
### these commands should be manually invoked when ever needed (e.g. when volumes are destroyed) - no real need to have it in the entrypoint
#
#echo "Cloning source repositories"
#/data/website/scripts/init.sh
#
#
#echo "Generate original (old) releases"
#/data/website/scripts/spec_populate_original_releases.sh
#
#echo "Generate current releases"
#/data/website/scripts/spec_populate_releases_all.sh

exec "$@"
