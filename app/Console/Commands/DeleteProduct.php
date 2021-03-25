<?php

namespace App\Console\Commands;

use App\Contracts\ProductServiceContract;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Foundation\Application;

class DeleteProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:product {id : the id of the product you want to delete}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command helps deleting a product providing its id.';

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
            $productService->deleteProduct($this->argument('id'));
            $this->info("The product with the id {$this->argument('id')} has been deleted successfully");

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
