<?php

namespace App\Console\Commands;

use App\Contracts\CategoryServiceContract;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class CreateCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:category {name : the name of the category} {--parent=0 : the id of the parent category}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command helps creating a category';

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
    public function handle(CategoryServiceContract $categoryService)
    {
        try {
            $id = $categoryService->create($this->argument('name'), $this->option('parent'));
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
    }
}
