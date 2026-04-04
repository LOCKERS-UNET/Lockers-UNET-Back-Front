<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_a_successful_response()
    {
        $user = User::factory()->create();

        // 2. Usamos actingAs($user) para autenticarnos
        $response = $this->actingAs($user)->get(route('home'));

        // 3. Ahora sí, el middleware 'auth' nos dejará pasar y devolverá 200 (assertOk)
        $response->assertOk();
    }
}
