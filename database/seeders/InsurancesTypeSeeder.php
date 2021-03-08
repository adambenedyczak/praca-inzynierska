<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InsurancesTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $elementy = [
            1 => 'Ubezpieczenie OC',
            2 => 'Ubezpieczenie AC',
            3 => 'inne'
        ];

        foreach ($elementy as $key => $element){
            DB::table('objects_type')->insert([
                'name' => $element
            ]);
        }
    }
}
