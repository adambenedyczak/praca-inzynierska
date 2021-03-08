<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ElementsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $elementy = [
            1 => 'Część',
            2 => 'Przegląd',
            3 => 'Ubezpieczenie'
        ];

        foreach ($elementy as $key => $element){
            DB::table('elements_category')->insert([
                'name' => $element
            ]);
        }
    }
}
