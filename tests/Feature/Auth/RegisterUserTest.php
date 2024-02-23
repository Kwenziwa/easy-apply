<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_register_with_full_details()
    {
        $response = $this->post('/register', [
            'first_name' => 'John',
            'middle_name' => 'Quincy',
            'last_name' => 'Doe',
            'national_id' => '1234567891234',
            'date_of_birth' => '2000-01-01',
            'email' => 'john.doe@example.com',
            'phone_number' => '1234567890',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect('email/verify'); // Adjust this according to where your application redirects users after registration.
        $this->assertDatabaseHas('users', [
            'email' => 'john.doe@example.com',
        ]);
        $this->assertTrue(auth()->check()); // Ensure a user is authenticated after registration.
    }
}
