## Install project steps
- composer install
- cp .env.example .env
- ./vendor/bin/sail up -d
- ./vendor/bin/sail artisan key:generate
- ./vendor/bin/sail artisan migrate  
    or with seed ./vendor/bin/sail artisan migrate --seed
- ./vendor/bin/sail npm install
- ./vendor/bin/sail npm run dev

## Ports

**Must be available** MYSQL PORT 3307; SERVER PORT: 80

## Feature Test Command

- ./vendor/bin/sail test
