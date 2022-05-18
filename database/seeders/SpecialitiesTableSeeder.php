<?php

namespace Database\Seeders;

use App\Models\Speciality;
use Illuminate\Database\Seeder;

class SpecialitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'name'           => 'Окулист',
            ],
            [
                'name'           => 'Дерматолог',
            ],
            [
                'name'           => 'Венеролог',
            ],
            [
                'name'           => 'Психолог',
            ],
            [
                'name'           => 'Терапевт',
            ],
        ];

        Speciality::insert($items);
    }
}
