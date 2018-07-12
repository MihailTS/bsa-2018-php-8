<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CurrencyListPageTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_empty_currencies_list()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/currencies')
                    ->assertSee('No currencies');
            }
        );
    }

    public function test_not_empty_currencies_list()
    {
        $this->seed(\CurrenciesSeeder::class);

        $this->browse(
            function (Browser $browser) {
                $browser->visit('/currencies')
                    ->assertDontSee('No currencies');
            }
        );
    }

    public function test_see_header_text()
    {
        $this->seed(\CurrenciesSeeder::class);

        $this->browse(
            function (Browser $browser) {
                $browser->visit('/currencies')
                    ->assertSee('Currency market');
            }
        );
    }

    public function test_go_to_currency_page()
    {
        $this->seed(\CurrenciesSeeder::class);

        $this->browse(
            function (Browser $browser) {
                $browser->visit('/currencies')
                    ->assertSee('Bitcoin')
                    ->clickLink('Bitcoin')
                    ->assertPathIs('/currencies/1')
                    ->back()
                    ->assertSee('Ethereum')
                    ->clickLink('Ethereum')
                    ->assertPathIs('/currencies/2');
            }
        );
    }

    public function test_currency_data()
    {
        $this->seed(\CurrenciesSeeder::class);

        $this->browse(
            function (Browser $browser) {
                $browser->visit('/currencies')
                    ->assertSeeLink('Bitcoin')
                    ->assertSee('btc')
                    ->assertSee('Edit')
                    ->assertSee('Delete')
                    ->assertPresent('img');
            }
        );
    }
}
