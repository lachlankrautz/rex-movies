<?php
namespace Tests\Feature;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MovieTest extends TestCase
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
     * Show listing of movies.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get(url('api/movie?api_token=' . $this->api_token));
        $response->assertStatus(200);
        $response->assertSeeText('No Country for Old Men');
        $response->assertSeeText('Freaky Friday');
        $response->assertSeeText('Beyond the Black Rainbow');
    }

    public function testShow()
    {
        $response = $this->get(url('api/movie/2?api_token=' . $this->api_token));
        $response->assertStatus(200);

        $response = $this->get(url('api/movie/200?api_token=' . $this->api_token));
        $response->assertStatus(404);
    }

    public function testDelete()
    {
        $response = $this->delete(url('api/movie/3?api_token=' . $this->api_token));
        $response->assertStatus(200);

        $response = $this->get(url('api/movie/3?api_token=' . $this->api_token));
        $response->assertStatus(404);
        $response->assertJsonMissing([ 'name' => 'Beyond the Black Rainbow' ]);
    }

    public function testStore()
    {
        // good data
        $data = [
            'name' => 'The Emperor\'s New Groove',
            'rating' => '7.3',
            'description' => 'Emperor Kuzco is turned into a llama by his ex-administrator Yzma, and must now regain his throne with the help of Pacha, the gentle llama herder.',
            'genres' => [ 1, 2, 3 ],
            'cast' => [
                [ 'actor_id' => 1, 'character_name' => 'Emperor Kuzco' ],
                [ 'actor_id' => 2, 'character_name' => 'Yzma']
            ]
        ];
        $response = $this->post(url('api/movie?api_token=' . $this->api_token), $data);
        $response->assertStatus(200);
        $response->assertSeeText('The Emperor\'s New Groove');
        $response->assertSeeText('Thriller');
        $response->assertSeeText('Drama');
        $response->assertSeeText('Crime');
        $response->assertSeeText('Emperor Kuzco');
        $response->assertSeeText('Yzma');

        $id = $this->_data_get_id($response->json());
        $this->assertNotEmpty($id);

        $response = $this->get(url("api/movie/{$id}?api_token={$this->api_token}"));
        $response->assertStatus(200);
        $response->assertSeeText('The Emperor\'s New Groove');

        // bad data
        $data = [
            'name' => 'The Emperor\'s New Groove',
            'rating' => '7.3',
        ];
        $response = $this->post(url('api/movie?api_token=' . $this->api_token), $data);
        $response->assertStatus(422);
    }

    public function testUpdate()
    {
        // good data
        $data = [
            'name' => 'Freaky Freaky',
            'rating' => '1.2',
            'description' => 'There is nothing to say.'
        ];
        $response = $this->put(url('api/movie/2?api_token=' . $this->api_token), $data);
        $response->assertStatus(200);
        $response->assertSeeText('Freaky Freaky');

        $response = $this->get(url('api/movie/2?api_token={$this->api_token}'));
        $response->assertStatus(200);
        $response->assertSeeText('Freaky Freaky');
    }

}
