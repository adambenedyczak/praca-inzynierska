<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OverviewsTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $elementy = [
            1 => 'Przeglądy homologacyjne',
            2 => 'Przeglądy okresowe',
            3 => 'Przeglądy techniczne'
        ];

        foreach ($elementy as $key => $element){
            DB::table('overviews_type')->insert([
                'name' => $element
            ]);
        }
    }
}
