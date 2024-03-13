<?php

namespace Tests\Feature;

use App\Models\HolidayPlan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HolidayPlansTest extends TestCase
{
    use RefreshDatabase;

    public function test_generate_pdf(): void
    {
        $user = User::factory()->create();
        auth()->login($user);

        $plan = HolidayPlan::factory()->create();

        $response = $this->getJson("/api/holiday-plans/get-pdf/$plan->id");

        $response->assertOk();
    }
}
