<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class DoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialities = [1, 2, 3, 4];
        $items = [
            [
                'name' => 'Иванов И.И.',
                'speciality_id' => Arr::random($specialities)
            ],
            [
                'name' => 'Петров И.И.',
                'speciality_id' => Arr::random($specialities)
            ],
            [
                'name' => 'Сидоров И.И.',
                'speciality_id' => Arr::random($specialities)
            ],
            [
                'name' => 'Козлов И.И.',
                'speciality_id' => Arr::random($specialities)
            ],
            [
                'name' => 'Петренко И.И.',
                'speciality_id' => Arr::random($specialities)
            ],
            [
                'name' => 'Лягушенко И.И.',
                'speciality_id' => Arr::random($specialities)
            ],
        ];

        Doctor::insert($items);
    }
}
