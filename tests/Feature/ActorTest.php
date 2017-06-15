<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ActorTest extends TestCase
{

    /** @var string $api_token */
    private  $api_token;

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
     * Show listing of actors.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get(url('api/actor?api_token=' . $this->api_token));
        $response->assertStatus(200);
        $response->assertSeeText('Michael Rogers');
        $response->assertSeeText('Eva Bourne');
        $response->assertSeeText('Scott Hylands');
    }

    public function testShow()
    {
        $response = $this->get(url('api/actor/1/?api_token=' . $this->api_token));
        $response->assertStatus(200);
        $response->assertSeeText('Michael Rogers');

        $response = $this->get(url('api/actor/20/?api_token=' . $this->api_token));
        $response->assertStatus(404);
    }


    public function testDelete()
    {
        $response = $this->delete(url('api/actor/9?api_token=' . $this->api_token));
        $response->assertStatus(200);

        $response = $this->get(url('api/actor/9?api_token=' . $this->api_token));
        $response->assertStatus(404);
        $response->assertJsonMissing([ 'name' => 'Michael Rogers' ]);
    }
    
    public function testStore()
    {
        // good data
        $data = [
            'name' => 'Guy Pierce',
            'dob' => '2015-01-02',
            'bio' => 'Has not done much lately.',
            'multipart' => [[
                'name'     => 'test_file',
                'contents' => fopen('/var/www/public/images/john_astin.jpg', 'r')
            ]]
        ];
        $response = $this->post(url('api/actor?api_token=' . $this->api_token), $data);
        $response->assertStatus(200);
        $response->assertSeeText('Guy Pierce');

        $id = $this->_data_get_id($response->json());
        $this->assertNotEmpty($id);

        $response = $this->get(url("api/actor/{$id}?api_token={$this->api_token}"));
        $response->assertStatus(200);
        $response->assertSeeText('Guy Pierce');

        // bad data
        $data = [
            'name' => 'Guy Pierce',
            'dob' => '2015-01-02',
        ];
        $response = $this->post(url('api/actor?api_token=' . $this->api_token), $data);
        $response->assertStatus(422);
    }

    public function testUpdate()
    {
        // good data
        $data = [
            'name' => 'Tom Hanks',
            'dob' => '2000-05-02',
            'bio' => 'Just the worst.'
        ];
        $response = $this->put(url('api/actor/10?api_token=' . $this->api_token), $data);
        $response->assertStatus(200);
        $response->assertSeeText('Tom Hanks');

        $id = $this->_data_get_id($response->json());
        $this->assertNotEmpty($id);

        $response = $this->get(url("api/actor/10?api_token={$this->api_token}"));
        $response->assertStatus(200);
        $response->assertSeeText('Tom Hanks');
    }

}
