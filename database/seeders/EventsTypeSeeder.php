<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventsTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $elementy = [
            1 => 'wykonany',
            2 => 'do wykonania'
        ];

        foreach ($elementy as $key => $element){
            DB::table('events_type')->insert([
                'name' => $element
            ]);
        }
    }
}
