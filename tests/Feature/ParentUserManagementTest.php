<?php

namespace Tests\Feature;

use App\Models\ParentUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ParentUserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_parent_user_can_add_a_partner()
    {
        $this->withoutExceptionHandling();

        $parentUser = ParentUser::factory()->create();
        $this->actingAs($parentUser);

        $partner = ParentUser::factory()->create();
        $this->postJson(route('parents.invite'), $partner->toArray())
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Invitation sent',
            ]);

    }
    public function test_parent_user_can_not_add_himself_as_a_partner()
    {
        $this->withoutExceptionHandling();

        $parentUser = ParentUser::factory()->create();
        $this->actingAs($parentUser);

        $this->postJson(route('parents.invite'), $parentUser->toArray())
            ->assertStatus(400)
            ->assertJson([
                'message' => 'You can not invite yourself',
            ]);

    }
}
