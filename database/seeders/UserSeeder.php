<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'nama_lengkap' => 'user',
            'email' => 'user@gmail.com',
            'nohp' => 123,
            'username' => 'user',
            'password' => bcrypt('123'),
        ]);

        $user->assignRole('user');
    }
}
