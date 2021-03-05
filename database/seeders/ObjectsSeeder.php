<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        DB::table('objects')->insert([
            'name' => 'Ford Fusion',
            'object_type_id' => '1',
            'user_id' => '1',
            'work_time_unit_id' => '1'
        ]);

        DB::table('objects')->insert([
            'name' => 'Fogo FDG 250',
            'object_type_id' => '3',
            'user_id' => '1',
            'work_time_unit_id' => '2'
        ]);

        DB::table('objects')->insert([
            'name' => 'Fogo FDG 80',
            'object_type_id' => '3',
            'user_id' => '1',
            'work_time_unit_id' => '2'
        ]);

        DB::table('objects')->insert([
            'name' => 'Rumpumpa',
            'object_type_id' => '2',
            'user_id' => '1',
            'work_time_unit_id' => '0'
        ]);
    }
}
