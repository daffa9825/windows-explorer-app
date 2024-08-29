<?php

namespace Tests\Feature;

use App\Models\Folder;
use App\Models\SubFolder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FolderTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use WithFaker, RefreshDatabase;
    public function testListFolder()
    {
        $folder = $this->generateFolder();

        $response = $this->get('/api/folder');

        $response->assertStatus(200)
                ->assertJson([
                    'status' => 'success',
                    'data' => [
                        [
                            'id' => $folder->id,
                            'name' => $folder->name,
                            'created_at' => $folder->created_at,
                            'updated_at' => $folder->created_at,
                        ]
                    ],
                    'message' => 'Successfully retrieved data!'
                ]);
    }
    public function testListSubFolder()
    {
        $folder = $this->generateFolder();
        $subFolder = $this->generateSubFolder($folder->id);

        $response = $this->get('/api/'.$folder->id.'/sub_folder');
        $response->assertStatus(200)
        ->assertJson([
            'status' => 'success',
                'data' => [
                    'id' => $folder->id,
                    'name' => $folder->name,
                    'created_at' => $folder->created_at,
                    'updated_at' => $folder->updated_at,
                    'sub_folders' => [
                        [
                            'id' => $subFolder->id,
                            'folder_id' => $subFolder->folder_id,
                            'name' => $subFolder->name,
                            'type' => $subFolder->type,
                            'size' => $subFolder->size,
                            'created_at' => $folder->created_at,
                            'updated_at' => $folder->updated_at
                        ]
                    ]
                ],
                'message' => 'Successfully retrieved data!'
        ]);
    }
    public function generateFolder(){
        $createdAt = $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s');
        $folder = Folder::create([
            'name' => $this->faker->word,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
            'updated_at' => $this->faker->dateTimeBetween($createdAt, 'now')->format('Y-m-d H:i:s')
        ]);
        return $folder;
    }
    public function generateSubFolder($folder_id, $name = null){
        $name = $name ?: $this->faker->word;
        $createdAt = $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s');
        $subFolder = SubFolder::create([
            'name' => $name,
            'folder_id' => $folder_id,
            'type' => "folder",
            'created_at' => $createdAt,
            'updated_at' => $this->faker->dateTimeBetween($createdAt, 'now')->format('Y-m-d H:i:s')
        ]);
        return $subFolder;
    }

}
