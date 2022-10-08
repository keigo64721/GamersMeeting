<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 50; $i++){
            DB::table('statuses')->insert([
                'user_id' => $i,
                'age' => 1,
                'sex' => '未選択',
                'game_id' => 1,
                'playstyle' => 0,
                'playwith' => Str::random(100),
                'comment' => Str::random(100),
                'img_url' => 'img/18448.jpg',
                'set' => 1,
            ]);
        }
    }
}
