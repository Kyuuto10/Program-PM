<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
            'username' => 'ahmad',
            'name' => 'Ahmad',
            'email' => 'ahmad@example.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ],
        [
            'username' => 'user',
            'name'=>'Akun non-admin',
            'email'=>'user@gmail.com',
            'role'=>'editor',
            'password'=> bcrypt('123456'),
        ],
    ];

    foreach( $user as $key => $value){
        User::create($value);
    }
    }
}
