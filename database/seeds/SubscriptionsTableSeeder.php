<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscriptions')
            ->insert([
                ['name'=>'Спортзал'],
                ['name'=>'Спортзал+бассейн']
            ]);
    }
}
