<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObjectDetailsTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $elementy = [
            1 => 'Marka',
            2 => 'Model',
            3 => 'Tablica rejestracyjna',
            4 => 'VIN/SN',
        ];

        foreach ($elementy as $key => $element){
            DB::table('object_details_type')->insert([
                'name' => $element
            ]);
        }
    }
}
