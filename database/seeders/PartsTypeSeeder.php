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
            1 => 'Olej silnikowy',
            2 => 'Płyn chłodniczy',
            3 => 'Filtr paliwa',
            4 => 'Filtr oleju',
            5 => 'Filtr powietrza',
            6 => 'Filtr kabinowy'
        ];

        foreach ($elementy as $key => $element){
            DB::table('parts_type')->insert([
                'name' => $element
            ]);
        } 
    }
}
