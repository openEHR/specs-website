# specs-website

This is the `specifications.openehr.org` website source code repository.
It can be run as the following variants:
 - production https://specifications.openehr.org
 - (deprecated) test https://specifications-test.openehr.org or https://specifications-dev.openehr.org
 - development (local) https://specifications.openehr.local as built image
 - development (local) https://specifications-dev.openehr.local using mounted source code

### Build and run instructions

It is recommended to use `docker-compose` to have this website running for a development environment.

First, in linux bash, macOS terminal or powershell build the image by running (from this project directory):
```bash
docker-compose build
```

It will build a service named _web_. 

Then run the following in order to bring up webservice and a reverse proxy _caddy_ that will serve the website under `specifications.openehr.local`:
```bash
docker-compose up -d
```

To get access to a bash prompt and run CLI scripts inside the container, the following should be executed from linux bash, macOS terminal or powershell:
```bash
docker-compose exec web bash
```

The _web_ service will run Apache and PHP; the DocumentRoot is set to be `/app/public`.

The source code is located under the `/app/src`, whereas the main application configuration 
is stored under `/app/config`.

Various scripts are located under `/app/scripts` directory:
- The `init.sh` script should be used to clone all specifications repositories under `/data/repos` subdirectory.
- The `spec_populate_releases_all.sh` should be used to generate an export of all tags and releases under `/data/releases`
which is used by the website to serve static content (html pages, diagrams, expressions, etc).
- The `spec_populate_original_releases` should generate original (old) releases

To (re)build cache of all manifest files, a simple `GET` action is required on http://specifications.openehr.local/manifest url.

### Configuration

In order to configure some aspects of the website, the `/app/.env` file should be changed (or created based on `.env.dist`):
```ini
APP_ENV=production
APP_DEBUG=false
APP_HOOK_SECRET=abc
```

By default, the website runs in production mode and debug mode is off, which means some files are cached; it is recommended to change this in development mode 
by setting the `APP_ENV=development` and `APP_DEBUG=true`. 

### Initializing
In order to work the websites needs all openEHR git repositories under `/data/repos` and releases under `\data\releases`.
The necessary commands to run this in the `web` (or `web-dev`) as `www-data` user container are:
```bash
cd /app/scripts
echo "Cloning source repositories"
./init.sh
echo "Generate original (old) releases"
./spec_populate_original_releases.sh
echo "Generate current releases"
./spec_populate_releases_all.sh
```

### Development
For local development purpose, another variant of the website can be used, which has the website source code and the git repose mounted as volumes:
```bash
docker-compose build web-dev
docker-compose --profile dev up web-dev -d
```
CLI will be available through:
```bash
docker-compose --profile dev exec web-dev bash
```
This website will be available as https://specifications-dev.openehr.local

### Monitoring
Start docker compose with `--profile monitor`, e.g. 
```bash
docker compose --profile dev --profile monitor up web-dev prometheus cadvisor node_exporter -d
```
then you can access:
 - Prometheus at https://mon-prometheus.specifications-dev.openehr.local/ and 
 - cadvisor at https://mon-cadvisor.specifications-dev.openehr.local/ 
