<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->insert([
            'name' => 'ApexLegends',
        ]);
        DB::table('games')->insert([
            'name' => 'Valorant',
        ]);
        DB::table('games')->insert([
            'name' => 'Call of Duty',
        ]);
        DB::table('games')->insert([
            'name' => 'FORTNITE',
        ]);
        DB::table('games')->insert([
            'name' => '荒野行動',
        ]);
    }
}
