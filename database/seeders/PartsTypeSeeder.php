<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartsTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $elementy = [
            1 => 'Oleje',
            2 => 'Filtry',
            3 => 'Układ hamulcowy',
            4 => 'Układ napędowy',
            5 => 'Układ kierowniczy',
            7 => 'Ogumienie',
            6 => 'Inne',
        ];

        foreach ($elementy as $key => $element){
            DB::table('parts_type')->insert([
                'name' => $element
            ]);
        }
    }
}
