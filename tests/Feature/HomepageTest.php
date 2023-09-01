<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomepageTest extends TestCase
{
    //use RefreshDatabase;
    /**
     * Home Page unit test.
     *
     * @return void
     */
    public function test_homepage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    /**
     * Show Quotes Route unit test.
     *
     * @return void
     */
    public function test_showquotes(){
        $response = $this->post('/showQuotes', [
            'password' => 'dummy',
        ]);
        $response->assertViewIs('quotes');

    }
    /**
     * Mark As Favourite Route unit test.
     *
     * @return void
     */
    public function test_markAsFavourite(){
        $response = $this->post('/markAsFavourite', [
            'markedFavourite' => 'This Quote is for test',
        ]);
        $response->assertRedirectToRoute($name = 'showFavourite', $parameters = []);
    }

    /**
     * Show Favourite Route unit test.
     *
     * @return void
     */
    public function test_showFavourite(){
        $response = 
        $this->withSession(['validUser' => true])->get('/showFavourite');
        $response->assertViewIs('favourite');
    }

    /**
     * Delete Favourite Route unit test.
     *
     * @return void
     */
    public function test_deleteFavourite(){
        $response = $this->post('/deleteFavourite',[
            'id'=>1
        ]);
        $response->assertRedirectToRoute($name = 'showFavourite', $parameters = []);
    }
}
