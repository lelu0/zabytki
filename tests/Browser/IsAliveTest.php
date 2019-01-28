<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class IsAliveTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @test
     * @return void
     */
    public function websiteAlive()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Katalog zabytków')
                    ->assertSee('PRZEGLĄDAJ KATALOG')
                    ->assertSee('DODAJ NOWY');
        });
    }

    
}
