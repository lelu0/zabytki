<?php

namespace Tests\Browser;


use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MonumentTest extends DuskTestCase
{
   
    /**
     * @test
     */

    public function accessControlTest(){
        $this->browse(function (Browser $browser) {
            $browser->visit('/monuments/create')
                    ->assertSee('Login')
                    ->assertSee('E-Mail')
                    ->assertSee('Hasło');
        });
    }

    /**
     * @test
     */
    public function addTest(){        
        $this->monumentName = 'z_'.time();        
        $this->commentText = 'comment_test_'.time();
        $this->browse(function ($first, $second) {
            $first->loginAs(User::find(1))
                  ->visit('/monuments/create')
                  ->assertSee('Dodaj zabytek')
                  ->type('name', $this->monumentName)
                  ->select('category_id', 'Nowa')
                  ->type('short_description', 'Krotki opis')
                  ->type('description', 'blablabla')
                  ->type('city', 'Wrocław')
                  ->check('in_area')
                  ->press('Dodaj')
                  ->visit('/dashboard')
                  ->assertSee($this->monumentName)
                  ->clickLink($this->monumentName)
                  ->assertSee('Wrocław')
                  ->assertSee('blablabla')
                  ->type('text', $this->commentText)
                  ->press('Dodaj')
                  ->assertSee($this->commentText);
        });
    }


    
}
