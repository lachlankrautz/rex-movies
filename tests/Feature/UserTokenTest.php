<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTokenTest extends TestCase
{

    /**
     * Test accessing api_token.
     *
     * @return void
     */
    public function testAuthToken()
    {
        $response = $this->get(url('api/token?email=testing@gmail.com&password=secret'));
        $response->assertStatus(200);
        $response->assertSeeText('api_token');

        $response = $this->get(url('api/token?email=testing@gmail.com&password=secretz'));
        $response->assertStatus(401);


        // bad request (missing password)
        $response = $this->get(url('api/token?email=testing@gmail.com'));
        $response->assertStatus(400);
    }

    public function testWrongEndpoint()
    {
        $response = $this->get(url('api/tokenz?email=testing@gmail.com&password=secret'));
        $response->assertStatus(404);
    }
}
