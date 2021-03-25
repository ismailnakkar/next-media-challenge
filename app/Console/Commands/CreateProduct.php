<?php

namespace App\Console\Commands;

use App\Contracts\ProductServiceContract;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Foundation\Application;

class CreateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:product {name : the name of the product} {description} {price} {img_path : The path should be relative to the root directory of this app} {--categories=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is for creating a product';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(ProductServiceContract $productService, Application $app)
    {
        try {
            $categories = $this->option('categories') ? explode(",", $this->option('categories')) : [];
            $id = $productService->create($this->argument('name'), $this->argument('description'), $this->argument('price'), $this->argument('img_path'), $categories);
            $this->info("Your product has been added with the id: {$id}!");

            return 0;
        } catch (Exception $e) {

            if ($app->environment() === 'local') {
                $this->error($e->getMessage());
            } else {
                $this->error('Something went wrong! Please check your arguments.');
            }

            return 1;
        }
    }
}
