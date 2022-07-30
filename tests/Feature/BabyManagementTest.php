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

        $this->post('api/babies', $baby->toArray());
        $this->assertDatabaseHas('babies', $baby->toArray());
    }
}
