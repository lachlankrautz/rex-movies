<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GenreTest extends TestCase
{
    /** @var string $api_token */
    private  $api_token;

    /**
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();
        $user = User::where('email', '=', 'testing@gmail.com')->first();
        if (!empty($user)) {
            $this->api_token = $user->api_token;
        }
    }

    /**
     * @param  array $data
     * @return null|int
     */
    private function _data_get_id($data)
    {
        $id = null;
        if (!empty($data['data']) && !empty($data['data']['id'])) {
            $id = $data['data']['id'];
        }
        return $id;
    }

    /**
     * Show listing of genres.
     *
     * @return void
     */
    public function testIndex()
    {
        // full list
        $response = $this->get(url('api/genre?api_token=' . $this->api_token));
        $response->assertStatus(200);
        $response->assertSeeText('Thriller');
        $response->assertSeeText('Fantasy');
        $response->assertSeeText('Sci-Fi');
    }

    public function testShow()
    {
        // valid
        $response = $this->get(url('api/genre/5/?api_token=' . $this->api_token));
        $response->assertStatus(200);
        $response->assertSeeText('Family');

        // missing resource
        $response = $this->get(url('api/genre/50/?api_token=' . $this->api_token));
        $response->assertStatus(404);
    }

    public function testDelete()
    {
        $response = $this->delete(url('api/genre/7?api_token=' . $this->api_token));
        $response->assertStatus(200);

        $response = $this->get(url('api/genre/7?api_token=' . $this->api_token));
        $response->assertStatus(404);
        $response->assertJsonMissing([ 'name' => 'Sci-Fi' ]);
    }

    public function testStore()
    {
        // good data
        $data = [
            'name' => 'Romance',
            'movies' => [
                1, 3
            ]
        ];
        $response = $this->post(url('api/genre?api_token=' . $this->api_token), $data);
        $response->assertStatus(200);
        $response->assertSeeText('Romance');
        $response->assertSeeText('No Country for Old Men');
        $response->assertSeeText('Beyond the Black Rainbow');

        $id = $this->_data_get_id($response->json());
        $this->assertNotEmpty($id);

        $response = $this->get(url("api/genre/{$id}?api_token={$this->api_token}"));
        $response->assertStatus(200);
        $response->assertSeeText('Romance');

        // bad data
        $data = [
            'name' => null
        ];
        $response = $this->post(url('api/genre?api_token=' . $this->api_token), $data);
        $response->assertStatus(422);
    }

    public function testUpdate()
    {
        // good data
        $data = [
            'name' => 'Conspiracy'
        ];
        $response = $this->put(url('api/genre/8?api_token=' . $this->api_token), $data);
        $response->assertStatus(200);
        $response->assertSeeText('Conspiracy');

        $response = $this->get(url("api/genre/8?api_token={$this->api_token}"));
        $response->assertStatus(200);
        $response->assertSeeText('Conspiracy');
    }

}
