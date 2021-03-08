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
            2 => 'Filtr paliwa',
            3 => 'Filtr powietrza',
            4 => 'Filtr oleju'
        ];

        foreach ($elementy as $key => $element){
            DB::table('parts_type')->insert([
                'name' => $element
            ]);
        }
    }
}
