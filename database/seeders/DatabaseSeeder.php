<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Admin::create([
           'name' => 'Admin',
           'email' => 'admin@gmail.com',
           'password'=>Hash::make('password')
        ]);
        User::create([
            'first_name' => 'User',
            'last_name' => ' Demo',
            'email' => 'user@gmail.com',
            'password'=>Hash::make('password')
        ]);
    }
}
