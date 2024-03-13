<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_authentication_on_index_users_route(): void
    {
        $response = $this->getJson('/api/users');

        $response->assertJson(['message'=>'Unauthenticated.']);
        $response->assertUnauthorized();
    }

    public function test_authentication_on_index_plans_route(): void
    {
        $response = $this->getJson('/api/holiday-plans');

        $response->assertJson(['message'=>'Unauthenticated.']);
        $response->assertUnauthorized();
    }
}
