<?php

namespace Tests\Feature;

use App\Models\Categorie;
use App\Models\Video;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CategoriesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_can_user_list_all_videos()
    {
        $categories = Categorie::factory(3)->create();

        $response = $this->getJson('/api/categorias');

        $response->assertJsonCount(3);
        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json){
            $json->hasAll(['0.id', '0.title', '0.color']);

            $json->whereAllType([
                '0.id' => 'integer',
                '0.title' => 'string',
                '0.color' => 'string'
            ]);
        });
    }

    public function test_if_can_user_create_video()
    {
        $categorie = Categorie::factory()->make()->toArray();

        $response = $this->postJson('/api/categorias', $categorie);

        $response->assertStatus(201);

        $response->assertJson(function (AssertableJson $json) use($categorie){
            $json->whereAll([
                'title' => $categorie['title'],
                'color' => $categorie['color']
            ])->etc();
        });
    }

    public function test_if_can_user_list_one_video()
    {
        $categorie = Categorie::factory()->create();

        $response = $this->getJson('/api/categorias/' . $categorie->id);

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) use($categorie){
            $json->hasAll(['id', 'title', 'color']);

            $json->whereAllType([
                'id' => 'integer',
                'title' => 'string',
                'color' => 'string'
            ]);

            $json->whereAll([
                'id' => $categorie->id,
                'title' => $categorie->title,
                'color' => $categorie->color
            ]);
        });
    }

    public function test_if_can_user_update_video()
    {
        $categorie = Categorie::factory()->create();

        $update = [
            'title' => 'Atualizando categoria ...',
            'color' => '#fff'
        ];

        $response = $this->putJson('/api/categorias/' . $categorie->id, $update);

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) use($update){
            $json->whereAll([
                'title' => $update['title'],
                'color' => $update['color']
            ])->etc();
        });
    }

    public function test_if_can_user_delete_video()
    {
        $categorie = Categorie::factory()->create();

        $response = $this->deleteJson('/api/categorias/' . $categorie->id);

        $response->assertStatus(204);
    }

    public function test_if_can_user_list_video_by_categorie()
    {
        $categorie = Categorie::factory()->create();

        $video = Video::factory()->create([
            'categorie_id' => $categorie->id
        ]);

        $response = $this->getJson('/api/categorias/' . $categorie->id . '/videos');

        $response->assertStatus(200);
    }
}
