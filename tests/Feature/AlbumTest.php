<?php
namespace Tests\Feature;

use App\Albums;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AlbumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_will_show_all_albums()
    {
        $albums = factory(Albums::class, 10)->create();

        $response = $this->get(route('albums.index'));

        $response->assertStatus(200);

        $response->assertJson($albums->toArray());
    }

    /** @test */
    public function it_will_create_albums()
    {
        $response = $this->post(route('albums.store'), [
            'title'       => 'This is a title',
            'description' => 'This is a description'
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('albums', [
            'title' => 'This is a title'
        ]);

        $response->assertJsonStructure([
            'message',
            'albums' => [
                'title',
                'description',
                'updated_at',
                'created_at',
                'id'
            ]
        ]);
    }

    /** @test */
    public function it_will_show_a_album()
    {
        $this->post(route('albums.store'), [
            'title'       => 'This is a title',
            'description' => 'This is a description'
        ]);

        $albums = Albums::all()->first();

        $response = $this->get(route('albums.show', $albums->id));

        $response->assertStatus(200);

        $response->assertJson($albums->toArray());
    }

    /** @test */
    public function it_will_update_a_albums()
    {
        $this->post(route('albums.store'), [
            'title'       => 'This is a title',
            'description' => 'This is a description'
        ]);

        $albums = Albums::all()->first();

        $response = $this->put(route('albums.update', $albums->id), [
            'title' => 'This is the updated title'
        ]);

        $response->assertStatus(200);

        $albums = $albums->fresh();

        $this->assertEquals($albums->title, 'This is the updated title');

        $response->assertJsonStructure([
           'message',
           'albums' => [
               'title',
               'description',
               'updated_at',
               'created_at',
               'id'
           ]
       ]);
    }

    /** @test */
    public function it_will_delete_an_albums()
    {
        $this->post(route('albums.store'), [
            'title'       => 'This is a title',
            'description' => 'This is a description'
        ]);

        $albums = Albums::all()->first();

        $response = $this->delete(route('albums.destroy', $albums->id));

        $albums = $albums->fresh();

        $this->assertNull($albums);

        $response->assertJsonStructure([
            'message'
        ]);
    }
}
