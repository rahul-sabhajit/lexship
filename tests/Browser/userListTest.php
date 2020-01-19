<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class userListTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @test
     * @return void
     */
    public function testExample()
    {
            $this->browse(function (Browser $browser) {
                $browser->visit('/home')
                    ->press('userlist')
                    ->assertPathIs('/userlist?page=1');
            });
    }
}
