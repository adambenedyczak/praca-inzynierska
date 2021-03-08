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
            1 => 'Przegląd okresowy',
            2 => 'Przegląd homologacyjny',
            3 => 'Przegląd techniczny'
        ];

        foreach ($elementy as $key => $element){
            DB::table('overviews_type')->insert([
                'name' => $element
            ]);
        }
    }
}
