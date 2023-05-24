## About Laravel

1. cp .env.example .env
2. docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
3. ./vendor/bin/sail up -d
4. ./vendor/bin/sail yarn