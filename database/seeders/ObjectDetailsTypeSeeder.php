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
            3 => 'Numer seryjny',
            4 => 'Inne'
        ];

        foreach ($elementy as $key => $element){
            DB::table('object_details_type')->insert([
                'name' => $element
            ]);
        }
    }
}
