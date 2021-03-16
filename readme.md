# Description

Next media coding challenge by Ismail Nakkar

## Installation

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan storage:link # to make images accessible to the public folder
php artisan serve # starts a php server (access the website on http://127.0.0.1:8000/)
```

## Usage (console)

```bash
php artisan product:create {name} {--description=} {--price==} {--img_path=} #creates a product from the console (the path is relative the app root directory)
product:delete {id} # removes a product from the console. You must provide the product ID
php artisan category:create {name} {--parent=0} # creates a category with an optional parent category
php artisan category:delete {id} # deletes a category by ID

```
