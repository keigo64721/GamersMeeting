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
        for ($i = 1; $i <= 50; $i++){
            DB::table('swipes')->insert([
                'from_user_id' => $i,
                'to_user_id' => 51,
                'is_like' => true,
            ]);
        }
    }
}
