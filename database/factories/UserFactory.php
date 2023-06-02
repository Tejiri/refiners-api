<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "username" => "Tejiri",
            "password" => Hash::make("RefinersAdmin2023!"),
            "nextOfKinName" => "",
            "nextOfKinPhoneNumber" => "",
            "nextOfKinAddress" => "Warri",
            "occupation" => "Software Developer",
            "gender" => "Male",
            "address" => "Warri",
            "phoneNumber" => "+447393913905",
            "accountStatus" => "active",
            "middleName" => "Stephen",
            "lastName" => "Ijatomi",
            "firstName" => "Tejiri",
            "title" => "Mr",
            "dateOfBirth" => "23-03-2023",
            "role" => "admin",
            'email' => "steveijatomi@gmail.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
