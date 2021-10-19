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
            1 => 'Ubezpieczenia AC',
            2 => 'Ubezpieczenia OC',
            3 => 'Inne'
        ];

        foreach ($elementy as $key => $element){
            DB::table('insurances_type')->insert([
                'name' => $element
            ]);
        }
    }
}
