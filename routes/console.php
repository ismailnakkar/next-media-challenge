<?php

use App\Contracts\CategoryServiceContract;
use App\Contracts\ProductServiceContract;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
 */

/*

I used routes/console.php for simplicity

 */

Artisan::command('product:create {name} {--description=} {--price==} {--img_path=} {--categories=}', function ($name, $description, float $price, $img_path, $categories = []) {
    try {
        if ($categories) {
            $categories = explode(",", $categories);
        }
        $id = App::make(ProductServiceContract::class)->create($name, $description, $price, $img_path, $categories);
        $this->info("Your product has been added with the id: {$id}!");

        return 0;
    } catch (Exception $e) {
        if (App::environment() === 'local') {
            $this->error($e->getMessage());
        } else {
            $this->error('Something went wrong! Please check your arguments.');
        }

        return 1;
    }
});

Artisan::command('product:delete {id}', function ($id) {
    try {
        App::make(ProductServiceContract::class)->deleteProduct($id);
        $this->info("The product with the id {$id} has been deleted successfully");

        return 0;
    } catch (Exception $e) {
        if (App::environment() === 'local') {
            $this->error($e->getMessage());
        } else {
            $this->error('Something went wrong! Please check your arguments.');
        }

        return 1;
    }
});

Artisan::command('category:create {name} {--parent=}', function ($name, $parent = 0) {
    try {
        $id = App::make(CategoryServiceContract::class)->create($name, $parent);
        $this->info("A category has been added with the id: {$id}");

        return 0;
    } catch (Exception $e) {
        if (App::environment() === 'local') {
            $this->error($e->getMessage());
        } else {
            $this->error('Something went wrong! Please check your arguments.');
        }

        return 1;
    }
});

Artisan::command('category:delete {id}', function ($id) {
    try {
        App::make(CategoryServiceContract::class)->delete($id);
        $this->info("The category with the id {$id} has been deleted");

        return 0;
    } catch (Exception $e) {
        if (App::environment() === 'local') {
            $this->error($e->getMessage());
        } else {
            $this->error('Something went wrong! Please check your arguments.');
        }

        return 1;
    }
});
