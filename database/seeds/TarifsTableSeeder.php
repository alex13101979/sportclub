<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TarifsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tarifs')
            ->insert([
                ['name'=>'12'],
                ['name'=>'12-20%']
            ]);
    }
}
