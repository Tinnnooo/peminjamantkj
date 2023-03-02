<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'nama_lengkap' => 'admin',
            'email' => 'admin@gmail.com',
            'nohp' => 123,
            'username' => 'admin',
            'password' => bcrypt('123'),
        ]);

        $user->assignRole('admin');
    }
}
