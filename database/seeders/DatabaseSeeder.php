<?php

use Illuminate\Database\Seeder;
use App\Models\CustomerModel;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $userIds = User::pluck('id')->toArray();

        // Creating 10 fake users with random descriptions and image URLs
        for ($i = 0; $i < 25; $i++) {
            CustomerModel::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'description' => $faker->sentence(), // Generating a random sentence for description
                'image' => $faker->imageUrl(200, 200, 'people'), // Generating a random image URL
                'subject' => $faker->randomElement(['Technical Support', 'Feature Request', 'Bug Report', 'Data Access Request', 'User Account Request', 'Permission Request']), // Selecting a random department
                'department' => $faker->randomElement(['Marketing', 'Engineering', 'Finance', 'Human Resources', 'Sales', 'Operations']), // Selecting a random department
                'customer_id' => $faker->randomElement($userIds), // Assigning a random existing user ID
                'prio' => '1',
                'handler' => 'None',
                'status' => 'New',
            ]);
        }
    }
}