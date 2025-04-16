<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'diki',
            'email' => 'diki@mail.com',
            'password' => Hash::make('123') // jangan lupa pakai Hash!
        ]);
    }
}
