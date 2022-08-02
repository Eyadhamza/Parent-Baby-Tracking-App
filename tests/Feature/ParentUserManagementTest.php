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
            ->assertStatus(422);
    }

    public function test_a_user_parent_can_show_his_partner()
    {
        $this->withoutExceptionHandling();

        $parentUser = ParentUser::factory()->create();
        $this->actingAs($parentUser);

        $partner = ParentUser::factory()->create();
        $parentUser->invite($partner->id);

        $this->getJson(route('parents.index'))
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $partner->id,
                    'name' => $partner->name,
                    'email' => $partner->email,
                ],
            ]);
    }

    public function test_a_user_parent_can_register_with_his_name_or_id()
    {
        $this->withoutExceptionHandling();

        $this->postJson(route('parents.register'), [
            'id' => '12345',
            'name' => 'John Doe',
            'email' => 'John@gmail.com'
        ])->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'access_token',
                    'token_type',
                ]
            ]);
    }

    public function test_a_user_parent_can_login_with_id_or_name()
    {
        $this->withoutExceptionHandling();

        $parentUser = ParentUser::factory()->create();

        $this->postJson(route('parents.login'), [
            'id' => $parentUser->id,
            'name' => $parentUser->name,
        ])->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'access_token',
                    'token_type',
                ]
            ]);
    }
}
