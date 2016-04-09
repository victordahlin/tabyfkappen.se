<?php

use Illuminate\Database\Seeder;

class UsedOffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('offers_used')->insert(array(
            array('offer_id' => 1, 'user_id' => 1, 'type' => 'super_deal'),
            array('offer_id' => 2, 'user_id' => 1, 'type' => 'temporary_deal'),
            array('offer_id' => 3, 'user_id' => 2, 'type' => 'temporary_deal'),
        ));
    }
}
