# DevAdmin API

An API used to provide the data for the devadmin website.

A Laravel app that connects to MySQL to retrieve and update data.

Built with PHP 8.1.14.

# Setup

- Install packages
```
composer install
```
-  Copy env file
```
cp .env.example .env
```
-  Open .env file and fill in required values
```
vim .env
```

## Add DB tables and data

-  Run DB migrations
```
php artisan migrate
```
-  Run seeders for test data
```
php artisan db:seed
```
## Run dev version

-  Run on local environment
```
php artisan serve
```

## Run tests

Use the following command to run unit tests

```
php artisan test
```
