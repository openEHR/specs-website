# specs-website
Specifications website - https://specifications.openehr.org

### Build and run instructions

It is recommended to use `docker-compose` to have this website running for a development environment.

First, in linux bash, macOS terminal or powershell build the image by running (from this project directory):
```
docker-compose build
```

It will build a service name _openehr-specifications-website_. 

Then run the following in order to bring up webserver:
```
docker-compose up
```

It will run a container with Apache and PHP7.3, serving the openEHR specifications website at http://localhost:84/ address. The DocumentRoot is set to be `/var/www/html/public`.  

To get access to a bash prompt and run CLI scripts inside the container, the following should be executed from linux bash, macOS terminal or powershell:
```
docker-compose exec openehr-specifications-website bash
```


### Configuration

Various scripts are located under `/var/www/html/scripts/`directory.

The `init.sh` script should be used to clone all specifications repositories under `/var/www/html/git` subdirectory.

The `spec_populate_releases_all.sh` should be used to generate an export of all tags and releases under `/var/www/hosts/openehr.org/releases` which is use by the website to serve static content (html pages, diagrams, expressions, etc).

The `/var/www/config/settings.php` file should be changed to set few local variables. Examples (to be appended in teh file):
```php
ini_set('display_errors', 'On');
$settings['sites_root'] = '/var/www/vhosts/openehr.org';
$settings['error_handler_middleware']['display_error_details'] = true;
```

To (re)build cache of all manifest files, a GET action is required on http://localhost:84/manifest url.
