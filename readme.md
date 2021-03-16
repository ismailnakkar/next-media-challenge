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
php artisan product:create {name} {--description=} {--price==} {--img_path=} {--categories=?} #creates a product from the console (the image path is relative the app root directory)
# categories must be split by a comma (example: 1,2,3)
php artisan product:delete {id} # removes a product from the console. You must provide the product ID
php artisan category:create {name} {--parent=?} # creates a category with an optional parent category
php artisan category:delete {id} # deletes a category by ID

```
