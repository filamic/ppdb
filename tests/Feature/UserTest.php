<?php

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(TestCase::class,RefreshDatabase::class);

test('user login page is working', function () {
    $response = $this->get('/login');
    $response->assertStatus(200);
});

test('user can login',function(){
    $user = User::factory()->create();
    $response = $this
        ->actingAs($user)
        ->get('/')
        ->assertStatus(200);
});

// test('user can logout',function(){
//     $user = User::factory()->create();
//     $response = Auth::attempt($user->only('username', 'password'));
//     $response = $this->actingAs($user)->get('/logout');
// });