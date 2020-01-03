<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InformationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('information')->insert(
            array('app' => 'Test', 'tabyfk' => 'Test')
        );
    }
}
