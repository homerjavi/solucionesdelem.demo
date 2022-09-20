<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert( [
            [
                'name'     => 'Juan',
                'email'    => 'juan@juan.com',
                'password' => bcrypt( 'password' ),
                'created_at'  => now()
            ],
            [
                'name'     => 'Laura',
                'email'    => 'laura@laura.com',
                'password' => bcrypt( 'password' ),
                'created_at'  => now()
            ],
        ] );
    }
}
