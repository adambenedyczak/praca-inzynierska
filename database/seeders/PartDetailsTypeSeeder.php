<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartDetailsTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $elementy = [
            1 => 'Lepkość',
            2 => 'Pojemność',
            3 => 'Długość',
            4 => 'Szerokość'
        ];

        foreach ($elementy as $key => $element){
            DB::table('part_details_type')->insert([
                'name' => $element
            ]);
        }
    }
}
