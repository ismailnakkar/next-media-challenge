<?php

use App\Contracts\CategoryManagerContract;
use App\Contracts\ProductManagerContract;
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


//image path relative to the root directory of the application
Artisan::command('product:create {name} {--description=} {--price==} {--img_path=}', function($name, $description, Float $price, $img_path) {
    try {
        $id = App::make(ProductManagerContract::class)->createFromConsole($name, $description, $price, $img_path);
        $this->info("Your product has been added with the id: {$id}!");
        return 0;
    } catch (Exception $e) {
        if(App::environment() === 'local') {
            $this->error($e->getMessage());
        } else {
            $this->error('Something went wrong!');
        }
        return 1;
    }
});


Artisan::command('product:delete {id}', function($id){
    try {
        App::make(ProductManagerContract::class)->deleteProduct($id);
        $this->info("The product with the id {$id} has been deleted successfully");
        return 0;
    } catch (Exception $e) {
        if(App::environment() === 'local') {
            $this->error($e->getMessage());
        } else {
            $this->error('Something went wrong!');
        }
        return 1;
    }
});


Artisan::command('category:create {name} {--parent=0}', function($name, int $parent) {
    try {
        $id = App::make(CategoryManagerContract::class)->create($name, $parent);
        $this->info("A category has been added with the id: {$id}");
        return 0;
    } catch (Exception $e) {
        if(App::environment() === 'local') {
            $this->error($e->getMessage());
        } else {
            $this->error('Something went wrong!');
        }
        return 1;
    }
});

Artisan::command('category:delete {id}', function($id) {
    try {
        App::make(CategoryManagerContract::class)->delete($id);
        $this->info("The category with the id {$id} has been deleted");
        return 0;
    } catch (Exception $e) {
        if(App::environment() === 'local') {
            $this->error($e->getMessage());
        } else {
            $this->error('Something went wrong!');
        }
        return 1;
    }
});


