<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductCreationTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_product_from_console()
    {
        $this->artisan("product:create test --description=none --price=21.2 --img_path=image.png")
        ->expectsOutput("Your product has been added with the id: 1!")
        ->assertExitCode(0);

        $this->artisan("product:create test --description=none --price=21.2 --img_path=image1.png")
        ->assertExitCode(1);
    }
}
