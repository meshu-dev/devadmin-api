# Dev Admin API

This API is used to store websites used for development work with each website being linked to an environment which by default would be Dev, Test and Live.

## Install software (using Mac and brew)
### Composer
- Install with brew
```
brew install composer
```
### PHP 
- Install PHP 7.4 with brew
```
brew install php@7.4
```
## Setup 
- Install packages
```
composer install
```
- Copy the .env.example file to a new file named .env
- Fill in .env variables in new file
```
cp .env.example .env
```
- Run migrations
```
php bin/console doctrine:migrations:migrate
``` 
## Commands
- Run app
```
symfony serve -d
```
- Stop app
```
symfony server:stop
```
