<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        // this test helps to test that dusk is working
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Views Homework');
        });
    }
}
