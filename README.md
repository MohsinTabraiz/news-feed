# Dev Requirements

-   Docker (latest)
-   Make sure that ports used in docker-compose are free to use

## Setup

1. cp .env.example .env
2. Please note that I have installed the composer and npm in the docker-compose.yml for your convenience to install and setup the application (and also to show case a little that I understand working with docker and composer :p)  or alternatively you can use the command mentioned in third step to install composer packages and use the command mentioned in step 4 for installing the npm packages:
-   `docker-compose run --rm --user=$(id -u) npm install`
-   `docker-compose run --rm --user=$(id -u) composer install --ignore-platform-reqs`
3. docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
3. ./vendor/bin/sail up -d
4. ./vendor/bin/sail yarn 
5. ./vendor/bin/sail artisan migrate:fresh 
6. ./vendor/bin/sail test

# Features/Principles used/implemented

-   REST API
-   DRY
-   SOLID
-   KISS
-   Input Validation
-   Tests
-   Autoloading (Just to demonstrate that I understand how autoloading works in laravel, I create a simple limit function in Helpers\functions\pagination.php)

# Wanted to implement but could not due to time limitation...
- ElasticSearch, as instead of making direct calls to the external APIs, I cached the data fetched from the APIs into databases, just to show case data handling, manipulation, use of cron jobs etc... So I was really hoping to implement ElasticSearch to make the searching of the data even easier. 
- More better error handling. I could not implement proper error handling, exceptions with proper messages and details being thrown and handled. As I feel they are one of the most important aspects.
- More Unit and Feature tests
