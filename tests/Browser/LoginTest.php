<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @test
     * @return void
     */
    public function canLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Login')
                    ->type('email', 'lelu0@o2.pl')
                    ->type('password','Angelika1')
                    ->press('Zaloguj')
                    ->assertPathIs('/dashboard');
        });
    }
    /**
     * @test
     */
    public function dashboardTest(){
        $this->browse(function ($first, $second) {
            $first->loginAs(User::find(1))
                  ->visit('/dashboard/4')
                  ->assertSee('Do zatwierdzenia');
        });
    }
}
