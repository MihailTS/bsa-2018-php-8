<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PageHeaderTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();

        $this->seed(\CurrenciesSeeder::class);
    }

    public function test_see_currency_list_link()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/currencies')
                    ->assertSeeLink('Currencies')
                    ->clickLink('Currencies')
                    ->assertPathIs('/currencies');

                $browser->visit('/currencies/1')
                    ->assertSeeLink('Currencies')
                    ->clickLink('Currencies')
                    ->assertPathIs('/currencies');

                $browser->visit('/currencies/add')
                    ->assertSeeLink('Currencies')
                    ->clickLink('Currencies')
                    ->assertPathIs('/currencies');

                $browser->visit('/currencies/1/edit')
                    ->assertSeeLink('Currencies')
                    ->clickLink('Currencies')
                    ->assertPathIs('/currencies');
            }
        );
    }

    public function test_see_add_link()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/currencies')
                    ->assertSeeLink('Add')
                    ->clickLink('Add')
                    ->assertPathIs('/currencies/add');

                $browser->visit('/currencies/1')
                    ->assertSeeLink('Add')
                    ->clickLink('Add')
                    ->assertPathIs('/currencies/add');

                $browser->visit('/currencies/add')
                    ->assertSeeLink('Add')
                    ->clickLink('Add')
                    ->assertPathIs('/currencies/add');

                $browser->visit('/currencies/1/edit')
                    ->assertSeeLink('Add')
                    ->clickLink('Add')
                    ->assertPathIs('/currencies/add');
            }
        );
    }
}