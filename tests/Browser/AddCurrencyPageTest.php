<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AddCurrencyPageTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_form_is_present()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/currencies/add')
                    ->assertPresent('form');
            }
        );
    }

    public function test_all_fields_are_empty()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/currencies/add');

                $this->assertEmpty($browser->value('input[name=title]'));
                $this->assertEmpty($browser->value('input[name=short_name]'));
                $this->assertEmpty($browser->value('input[name=logo_url]'));
                $this->assertEmpty($browser->value('input[name=price]'));
            }
        );
    }

    public function test_csrf_token_is_present()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/currencies/add');

                $this->assertNotEmpty($browser->value('input[name=_token]'));
            }
        );
    }

    public function test_validates()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/currencies/add');

                $browser->press('Save')
                    ->assertPathIs('/currencies/add')
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

                $browser->visit('/currencies/add')
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

    public function test_saves_currency()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/currencies/add')
                    ->value('input[name=title]', 'Coin')
                    ->value('input[name=short_name]', 'cn')
                    ->value('input[name=price]', '9999')
                    ->value('input[name=logo_url]', 'https://example.com')
                    ->press('Save')
                    ->assertPathIs('/currencies')
                    ->assertSeeLink('Coin')
                    ->assertSee('cn')
                    ->assertSee('9999');
            }
        );
    }
}