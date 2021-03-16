<?php

namespace App\Providers;

use App\Contracts\CategoryManagerContract;
use App\Contracts\ProductManagerContract;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\EloquentCategory;
use App\Repositories\Product\EloquentProduct;
use App\Repositories\Product\ProductRepository;
use App\Services\CategoryManager;
use App\Services\ProductManager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ProductRepository::class, EloquentProduct::class);
        $this->app->singleton(CategoryRepository::class, EloquentCategory::class);
        $this->app->singleton(ProductManagerContract::class, ProductManager::class);
        $this->app->singleton(CategoryManagerContract::class, CategoryManager::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
