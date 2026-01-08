<?php

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

test('suspended user can not log in with valid credentials', function () {
    $user = User::first();
    $user->delete();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => '1', // assuming default password
    ]);

    $response->assertSessionHasErrors();
});

test('created user has USER role and a store', function () {
    $user = User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
    ]);

    $this->assertTrue($user->roles()->where('name', RoleEnum::USER)->exists());
    $this->assertCount(1, $user->stores()->get());
});