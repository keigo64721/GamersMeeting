<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SwipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 2; $i <= 49; $i++){
            DB::table('swipes')->insert([
                'from_user_id' => $i,
                'to_user_id' => 1,
                'is_like' => true,
            ]);
        }
    }
}
