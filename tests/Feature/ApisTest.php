<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApisTest extends TestCase
{
    /**
     * Get Quotes Api
     *
     * @return void
     */
    public function test_getQuotesApi()
    {
        $token = 'c5m7NTj6AlRj6pxmWCDvyVe48ArKB6XjQbfxR96tDj4OOH5VGDb4NiYSxTeb';
        $response = $this->get('/api/getQuotes/6?api_token='.$token);
        $response->assertStatus(200);
    }

    /**
     * Get Favourite Api
     *
     * @return void
     */
    public function test_getFavouriteApi()
    {
        $token = 'c5m7NTj6AlRj6pxmWCDvyVe48ArKB6XjQbfxR96tDj4OOH5VGDb4NiYSxTeb';
        $response = $this->get('/api/getFavourite?api_token='.$token);
        $response->assertStatus(200);
    }
}
