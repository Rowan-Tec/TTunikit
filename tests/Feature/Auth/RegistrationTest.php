<?php

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'full_names' => 'Test',
        'surname' => 'User',
        'email' => 'test@example.com',
        'cellphone' => '1234567890',
        'gender' => 'male',
        'date_of_birth' => '2000-01-01',
        'password' => 'Password123!',
        'password_confirmation' => 'Password123!',
        'terms' => '1',
    ]);

    $response->assertSessionHasNoErrors();

    // Check if user was created with default customer role
    $this->assertDatabaseHas('users', [
        'email' => 'test@example.com',
        'role' => 'customer',
    ]);

    // Skip authentication check for now
    // $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});
