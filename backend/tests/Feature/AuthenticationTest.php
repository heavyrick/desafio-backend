<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function registro_com_sucesso()
    {
        $userData = [
            "name" => "John",
            "last_name" => "Doe",
            "email" => "doe@example.com",
            "birthday" => "1990-01-20",
            "status" => 1,
            "account_balance" => 1000.00,
            "password" => Hash::make("123456"),
        ];

        $this->json('POST', 'api/register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure(["message"]);
    }
}
