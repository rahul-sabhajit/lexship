<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegistrationTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @test
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
            ->assertSee('register')
                ->Type('name', 'rahul')
                ->Type('email', 'rahul56@gmail.com')
                ->Type('password', 'test')
                ->Type('password_confirmation', 'test')
                ->press('submit')
                ->assertPathIs('/home');
        });
    }
}
