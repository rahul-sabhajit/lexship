<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LcmCalculatorTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @test
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/lcm')
                ->Type('number', '25 36 12')
                ->Type('methodType', '2')
                ->press('submit')
                ->assertPathIs('/lcm');
        });
    }
}
