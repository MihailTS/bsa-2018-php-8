<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EditCurrencyPageTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();

        $this->seed(\CurrenciesSeeder::class);
    }

    public function test_form_is_present()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/currencies/1/edit')
                    ->assertPresent('form');
            }
        );
    }

    public function test_see_old_model_values()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/currencies/1/edit');

                $this->assertEquals($browser->value('input[name=title]'), 'Bitcoin');
                $this->assertEquals($browser->value('input[name=short_name]'), 'btc');
                $this->assertEquals($browser->value('input[name=price]'), '725.55');
                $this->assertEquals(
                    $browser->value('input[name=logo_url]'),
                    'https://s2.coinmarketcap.com/static/img/coins/32x32/1831.png'
                );
            }
        );
    }

    public function test_csrf_token_is_present()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/currencies/1/edit');

                $this->assertNotEmpty($browser->value('input[name=_token]'));
            }
        );
    }

    public function test_validates()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/currencies/1/edit');

                $browser
                    ->value('input[name=title]', '')
                    ->value('input[name=short_name]', '')
                    ->value('input[name=logo_url]', '')
                    ->value('input[name=price]', '')
                    ->press('Save')
                    ->assertPathIs('/currencies/1/edit')
                    ->assertSee('The title field is required.')
                    ->assertSee('The short name field is required.')
                    ->assertSee('The logo url field is required.')
                    ->assertSee('The price field is required.');

                $browser
                    ->value('input[name=title]', 'Coin')
                    ->value('input[name=short_name]', 'cn')
                    ->value('input[name=logo_url]', 'broken-link')
                    ->value('input[name=price]', 'hello')
                    ->press('Save')
                    ->assertSee('The logo url format is invalid.')
                    ->assertSee('The price must be a number.');

                $browser
                    ->value('input[name=title]', '')
                    ->value('input[name=price]', -2)
                    ->press('Save')
                    ->assertSee('The title field is required.')
                    ->assertSee('The price must be at least 0.');
            }
        );
    }

    public function test_old_values_on_error()
    {
        $this->browse(
            function (Browser $browser) {
                $value = 'test';

                $browser->visit('/currencies/1/edit')
                    ->value('input[name=title]', $value)
                    ->value('input[name=short_name]', $value)
                    ->value('input[name=price]', $value)
                    ->value('input[name=logo_url]', $value)
                    ->press('Save');

                $this->assertEquals($browser->value('input[name=title]'), $value);
                $this->assertEquals($browser->value('input[name=short_name]'), $value);
                $this->assertEquals($browser->value('input[name=price]'), $value);
            }
        );
    }

    public function test_edit_currency()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/currencies/1/edit')
                    ->value('input[name=title]', 'Coin')
                    ->value('input[name=short_name]', 'cn')
                    ->value('input[name=price]', '9999')
                    ->value('input[name=logo_url]', 'https://example.com')
                    ->press('Save')
                    ->assertPathIs('/currencies/1')
                    ->assertSee('Coin')
                    ->assertSee('cn')
                    ->assertSee('9999');
            }
        );
    }
}