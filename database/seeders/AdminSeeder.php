<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'username' => 'Master Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin.disdik'),
            'is_admin' => true,
        ]);
    }
}
