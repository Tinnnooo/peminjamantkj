<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            'nama_lengkap' => 'guru',
            'email' => 'guru@gmail.com',
            'nohp' => 123,
            'username' => 'guru',
            'password' => bcrypt('123'),
        ]);

        $user->assignRole('guru');
    }
}
