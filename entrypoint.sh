#!/bin/sh

echo "Installing PHP external libraries"
composer install --no-dev --no-interaction --no-progress --no-ansi --classmap-authoritative

echo "Cloning source repositories"
/data/website/scripts/init.sh

echo "Generate original (old) releases"
/data/website/scripts/spec_populate_original_releases.sh

echo "Generate current releases"
/data/website/scripts/spec_populate_releases_all.sh

exec "$@"
