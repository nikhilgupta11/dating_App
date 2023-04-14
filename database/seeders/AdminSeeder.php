<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@addweb.com',
                'type' => 1,
                'password' => Hash::make('addweb@123'),
            ],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
