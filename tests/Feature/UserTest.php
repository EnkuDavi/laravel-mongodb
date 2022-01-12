<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use WithFaker;
    public function test_example()
    {
        $data = [
            'name' => $this->faker->name,
            'username' => $this->faker->username,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
            'phone' => '84375843'
        ];

        // $this->post(route('api.user'),$data)->assertStatus(201)->assetJson($data);
        $response = $this->post('/api/user', $data);
        $response->assertStatus(200)->assertJson($data);
    }
}
