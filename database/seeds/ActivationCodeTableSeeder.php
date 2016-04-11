<?php

use Illuminate\Database\Seeder;

class ActivationCodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('activation_codes')->insert(array(
            array('code' => 'test', 'is_used' => false),
            array('code' => 'test2', 'is_used' => false),
            array('code' => 'test3', 'is_used' => false),
            array('code' => 'test4', 'is_used' => false),
        ));
    }
}
