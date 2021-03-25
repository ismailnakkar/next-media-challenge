<?php

namespace App\Console\Commands;

use App\Contracts\CategoryServiceContract;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Foundation\Application;

class DeleteCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:category {id : the id of the category}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command helps deleting a category providing its id';

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
    public function handle(CategoryServiceContract $categoryService, Application $app)
    {
        try {
            $categoryService->delete($this->argument('id'));
            $this->info("The category with the id {$this->argument('id')} has been deleted");

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
