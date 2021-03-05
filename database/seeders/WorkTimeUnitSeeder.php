<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkTimeUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('work_time_units')->insert([
            'name' => 'Brak',
            'short' => ''
        ]);

        DB::table('work_time_units')->insert([
            'name' => 'Kilometry',
            'short' => 'km'
        ]);

        DB::table('work_time_units')->insert([
            'name' => 'Motogodziny',
            'short' => 'mh'
        ]);
    }
}
