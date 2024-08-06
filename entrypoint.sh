#!/bin/sh

if [ "$APP_SYSTEM" != "development" ]; then
  echo "entrypoint.sh: Installing PHP external libraries"
  composer install --no-dev --no-interaction --no-progress --no-ansi --classmap-authoritative
else
  echo "entrypoint.sh: Development mode detected - composer install has to be called manually, then run websites scripts to populate repos and releases"
fi

if [ "$SPEC_POPULATE_RELEASES" = "true" ]; then
  echo "entrypoint.sh: Cloning source repositories"
  /data/website/scripts/init.sh
  echo "entrypoint.sh: Generate original (old) releases"
  /data/website/scripts/spec_populate_original_releases.sh
  echo "entrypoint.sh: Generate current releases"
  /data/website/scripts/spec_populate_releases_all.sh
fi

exec "$@"
