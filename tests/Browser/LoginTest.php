<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @test
     * @return void
     */
    public function user_login()
    {

        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Login')
                ->Type('email', 'rahul23@gmail.com')
                ->Type('password', 'test')
                ->press('submit')
                ->assertPathIs('/home');

        });
    }
}
