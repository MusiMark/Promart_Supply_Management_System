<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $user=User::create([
            'id' => \App\Functions\Randomizer::generateID('CUS') ,
            'name' => 'Test User',
            'email' => 'user@promart.com',
            'role' => 'customer',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'), // set your password here
            'remember_token' => \Illuminate\Support\Str::random(10),
        ]);

        Customer::create([
            'id' => $user->id ,
            'phone' => '123-456-7890',
            'city' => 'New York',
            'address' => '123 Elm Street',
            'age_group' => '26-35',
            'gender' => 'male',
            'income_bracket' => 'middle',
            'purchase_frequency' => 'monthly',
            'shopping_preferences' => json_encode(['electronics', 'books']),
        ]);

        // [
        //         'id' => 'CUST00000000000002',
        //         'phone' => '987-654-3210',
        //         'city' => 'Los Angeles',
        //         'address' => '456 Maple Avenue',
        //         'age_group' => '36-45',
        //         'gender' => 'female',
        //         'income_bracket' => 'high',
        //         'purchase_frequency' => 'quarterly',
        //         'shopping_preferences' => json_encode(['fashion', 'beauty']),
        //     ],
        //     [
        //         'id' => 'CUST00000000000003',
        //         'phone' => '555-123-4567',
        //         'city' => 'Chicago',
        //         'address' => '789 Oak Lane',
        //         'age_group' => '18-25',
        //         'gender' => 'female',
        //         'income_bracket' => 'low',
        //         'purchase_frequency' => 'occasional',
        //         'shopping_preferences' => json_encode(['sports', 'gadgets']),
        //     ],


        
    }
}
