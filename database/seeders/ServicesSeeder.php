<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::insert( [
            [
                'user_id'     => 1,
                'title'       => 'Clases de piano',
                'description' => 'Imparto clases de piano, tengo 15 años de experiencia',
                'price'       => 10,
                'created_at'  => now()
            ],
            [
                'user_id'     => 1,
                'title'       => 'Clases de guitarra',
                'description' => 'Imparto clases de guitarra, tengo 12 años de experiencia',
                'price'       => 15,
                'created_at'  => now()
            ],
            [
                'user_id'     => 2,
                'title'       => 'Masajes',
                'description' => 'Soy fisioterapeuta y doy masajes a quien lo necesite',
                'price'       => 40,
                'created_at'  => now()
            ],
        ] );
    }
}
