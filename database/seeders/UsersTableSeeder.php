<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'steveijatomi@gmail.com')->first();
        if ($user == null) {
            User::factory()->create([
                "username" => "Tejiri",
                "email" => "steveijatomi@gmail.com",
                "password" => Hash::make("Refiners2023!"),
                "nextOfKinName" => "Daniel",
                "nextOfKinPhoneNumber" => "2332453523344",
                "nextOfKinAddress" => "Warri",
                "occupation" => "Software Developer",
                "gender" => "Male",
                "address" => "Plot 1603 Kaolack Street, Wuse  Zone 1,Abuja, Nigeria",
                "phoneNumber" => "+447393913905",
                "accountStatus" => "active",
                "middleName" => "Stephen",
                "lastName" => "Ijatomi",
                "firstName" => "Tejiri",
                "title" => "Mr",
                "dateOfBirth" => fake()->date(),
                "role" => "admin"
            ]);
        } else {
        }
    }
}
