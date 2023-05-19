<?php

namespace Tests\Feature;

use App\Models\Video;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;

class VideosTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_can_user_list_all_videos()
    {
        $videos = Video::factory(3)->create();

        $response = $this->getJson('/api/videos');

        $response->assertStatus(200);
        $response->assertJsonCount(3);

        $response->assertJson(function (AssertableJson $json){
            $json->hasAll(['0.id', '0.title', '0.description', '0.url', '0.categorie_id']);

            $json->whereAllType([
                '0.id' => 'integer',
                '0.title' => 'string',
                '0.description' => 'string',
                '0.url' => 'string',
                '0.categorie_id' => 'integer'
            ]);
        });
    }

    public function test_if_can_user_create_video()
    {
        $video = Video::factory()->make()->toArray();

        $response = $this->postJson('/api/videos', $video);

        $response->assertStatus(201);

        $response->assertJson(function (AssertableJson $json) use($video){
            $json->whereAll([
                'title' => $video['title'],
                'description' => $video['description'],
                'url' => $video['url'],
                'categorie_id' => $video['categorie_id']
            ])->etc();
        });
    }

    public function test_if_can_list_one_video()
    {
        $video = Video::factory()->create();

        $response = $this->getJson('/api/videos/' . $video->id);

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) use ($video){
            $json->hasAll(['id', 'title', 'description', 'url', 'categorie_id']);

            $json->whereAllType([
                'id' => 'integer',
                'title' => 'string',
                'description' => 'string',
                'url' => 'string',
                'categorie_id' => 'integer'
            ]);

            $json->whereAll([
                'id' => $video->id,
                'title' => $video->title,
                'description' => $video->description,
                'url' => $video->url,
                'categorie_id' => $video->categorie_id
            ]);
        });
    }

    public function test_if_can_user_update_video()
    {
        $video = Video::factory()->create();

        $update = [
            'title' => 'Atualizando video ..',
            'description' => 'Atualizando ..',
            'url' => 'https://www.youtube.com/watch?v=testando'
        ];

        $response = $this->putJson('/api/videos/' . $video->id, $update);

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) use($update){
            $json->whereAll([
                'title' => $update['title'],
                'description' => $update['description'],
                'url' => $update['url']
            ])->etc();
        });
    }

    public function test_if_can_user_edit_video()
    {
        $video = Video::factory()->create();

        $response = $this->deleteJson('/api/videos/' . $video->id);

        $response->assertStatus(204);
    }
}
