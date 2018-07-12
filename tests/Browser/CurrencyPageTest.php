<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CurrencyPageTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();

        $this->seed(\CurrenciesSeeder::class);
    }

    public function test_see_currency_data()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/currencies/1')
                    ->assertSee('Bitcoin')
                    ->assertSee('btc')
                    ->assertSee('725.55')
                    ->assertPresent('img')
                    ->assertSee('Edit')
                    ->assertSee('Delete');
            }
        );
    }

    public function test_edit_button()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/currencies/1')
                    ->assertSee('Edit')
                    ->click('.edit-button')
                    ->assertPathIs('/currencies/1/edit');
            }
        );
    }

    public function test_delete_button()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/currencies/1')
                    ->assertSee('Delete')
                    ->click('.delete-button')
                    ->assertPathIs('/currencies');
            }
        );
    }
}
