<?php

namespace Tests\Feature;

use App\Models\Baby;
use App\Models\ParentUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BabyManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_a_baby()
    {
        $this->withoutExceptionHandling();

        $parentUser = ParentUser::factory()->create();
        $this->actingAs($parentUser);

        $baby = Baby::factory()->make();

       $this->postJson(route('babies.store'), $baby->toArray())
            ->assertStatus(201)
            ->assertJson([
                    'data' => [
                        'message' => 'Resource Created Successfully',
                    ],
                ]);
        $this->assertDatabaseHas('babies', $baby->toArray());

    }

    public function test_it_can_update_a_baby()
    {
        $this->withoutExceptionHandling();

        $parentUser = ParentUser::factory()->create();
        $this->actingAs($parentUser);

        $baby = Baby::factory()->create();

        $newBabyData = [
            'id' => $baby->id,
            'name' => 'New Name',
        ];

        $this->putJson(route('babies.update', $baby) ,
            $newBabyData
        ) ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'message' => 'Resource Updated Successfully',
                ],
            ]);

        $this->assertDatabaseHas('babies',
            $newBabyData
        );
    }


    public function test_parent_is_the_only_one_who_can_delete_a_baby()
    {
        $this->withoutExceptionHandling();

        $parentUser = ParentUser::factory()->create();
        $this->actingAs($parentUser);

        $baby = Baby::factory()->create();

        $parentUser->babies()->save($baby);

        $this->deleteJson(route('babies.destroy', $baby))
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'message' => 'Resource Deleted Successfully',
                ],
            ]);

        $this->assertDatabaseMissing('babies',
            $baby->toArray()
        );
    }

    public function test_it_can_show_a_baby()
    {
        $this->withoutExceptionHandling();

        $parentUser = ParentUser::factory()->create();
        $this->actingAs($parentUser);

        $baby = Baby::factory()->create();
        $this->getJson(route('babies.show', $baby))
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $baby->id,
                    'name' => $baby->name,
                ],
            ]);


    }
}
