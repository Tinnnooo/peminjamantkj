<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
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
