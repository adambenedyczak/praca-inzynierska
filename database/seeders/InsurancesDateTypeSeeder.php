<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InsurancesDateTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $elementy = [
            1 => 'Ważne do',
            2 => 'Wykupione',
        ];

        foreach ($elementy as $key => $element){
            DB::table('insurances_date_type')->insert([
                'name' => $element
            ]);
        }
    }
}
