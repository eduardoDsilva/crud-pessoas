<?php

namespace Tests\Feature;

use Faker\Factory as Faker;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class PersonTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_person()
    {
        $faker = Faker::create();

        $user = User::factory()->create();

        Passport::actingAs($user);

        $email = $faker->unique()->safeEmail;

        $response = $this->postJson('/api/people', [
            'full_name' => $faker->name,
            'cpf' => $faker->numerify('###########'),
            'rg' => $faker->numerify('###########'),
            'birth_date' => $faker->date('Y-m-d', '2000-01-01'),
            'email' => $email,
            'phone' => $faker->phoneNumber,
            'gender' => $faker->randomElement(['male', 'female']),
            'marital_status' => $faker->randomElement(['single', 'married', 'divorced']),
            'nationality' => $faker->country,
            'occupation' => $faker->jobTitle,
            'address' => [
                'street' => $faker->streetAddress,
                'number' => $faker->buildingNumber,
                'complement' => $faker->secondaryAddress,
                'neighborhood' => $faker->word,
                'city' => $faker->city,
                'state' => $faker->state,
                'zip_code' => "93020-440",
                'country' => $faker->country,
            ]
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('people', [
            'email' => $email,
        ]);
    }


    public function test_create_person_with_duplicate_cpf()
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $this->postJson('/api/people', [
            'full_name' => 'John Doe',
            'cpf' => '11332672236',
            'rg' => '123456789',
            'birth_date' => '1990-01-01',
            'email' => 'johndoe@example.com',
            'phone' => '1234567890',
            'gender' => 'male',
            'marital_status' => 'single',
            'nationality' => 'Brazilian',
            'occupation' => 'Engineer',
            'address' => [
                'street' => '123 Main St',
                'number' => '45',
                'complement' => 'Apt 101',
                'neighborhood' => 'Downtown',
                'city' => 'CityName',
                'state' => 'StateName',
                'zip_code' => '12345-678',
                'country' => 'Brazil',
            ]
        ]);

        $response = $this->postJson('/api/people', [
            'full_name' => 'John Doe',
            'cpf' => '11332672236',
            'rg' => '123456789',
            'birth_date' => '1990-01-01',
            'email' => 'johndoe@example.com',
            'phone' => '1234567890',
            'gender' => 'male',
            'marital_status' => 'single',
            'nationality' => 'Brazilian',
            'occupation' => 'Engineer',
            'address' => [
                'street' => '123 Main St',
                'number' => '45',
                'complement' => 'Apt 101',
                'neighborhood' => 'Downtown',
                'city' => 'CityName',
                'state' => 'StateName',
                'zip_code' => '12345-678',
                'country' => 'Brazil',
            ]
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['cpf']);
    }
}
