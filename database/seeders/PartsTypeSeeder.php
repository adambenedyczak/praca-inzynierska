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
            1 => 'Filtry',
            2 => 'Inne',
            3 => 'Ogumienie',
            4 => 'Płyny i oleje',
            5 => 'Układ hamulcowy',
            7 => 'Układ kierowniczy',
            6 => 'Układ napędowy',
        ];

        foreach ($elementy as $key => $element){
            DB::table('parts_type')->insert([
                'name' => $element
            ]);
        }
    }
}
