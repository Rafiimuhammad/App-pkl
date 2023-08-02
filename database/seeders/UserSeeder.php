<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            'nimataunidn' => '238007021',
            'nama' => 'Ibu Ayu',
            'email' => 'admin@123.com',
            'password' => bcrypt('12345'),
            'level' => 'Koordinator',
            'remember_token' => Str::random(60),
        ]);
    }
}
