<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('offers')->insert(array(
            array(
                'company_id' => 1,
                'name' => 'Köp två LED betala för en',
                'description' => 'Nu har dagen äntligen kommit när vi kan erbjuda en kontorsarmatur med högsta LED-kvalitet till ett lägre pris än våra traditionella lysrörsarmaturer.',
                'end_date' => '2015-12-31',
                'is_super_deal' => false,
                'image_file_path' => 'flux.jpg',
            ),
            array(
                'company_id' => 2,
                'name' => 'Marockanska cementplattor 15%',
                'description' => 'Marockanska cementplattor är ett härligt sätt att inreda hemmet, handgjorda i 20x20 storlek med en stor variation av mönster. De marockanska plattorna är ofta en del av en större helhet, det vill säga att de tillsammans med andra plattor bildar större mön	',
                'end_date' => '2015-12-31',
                'is_super_deal' => true,
                'image_file_path' => 'marocanskaplattor.jpg',
            ),
            array(
                'company_id' => 3,
                'name' => 'Brandsläckare Nexa Pulver med brandfilt 120x180cm',
                'description' => 'Brandsläckarpaket från Nexa med en 6kg pulversläckare och en brandfilt 120 x 180 cm av glasfiber. Brandfiltar är gjorda av glasfiber som kan stå emot temperatur upp till 500 grader. Brandfilten är tät och står emot gasgenomträngning.',
                'end_date' => '2015-12-12',
                'is_super_deal' => false,
                'image_file_path' => 'brandslackare.jpg',
            ),
            array(
                'company_id' => 4,
                'name' => 'KOPIERING 20%',
                'description' => 'Vi kopierar medan du väntar (i rimliga upplagor)	',
                'end_date' => '2015-12-31',
                'is_super_deal' => false,
                'image_file_path' => 'kopiering.jpg',
            ),
            array(
                'company_id' => 4,
                'name' => 'Gratis värdering',
                'description' => '',
                'end_date' => '2015-12-05',
                'is_super_deal' => false,
                'image_file_path' => 'm.png',
            )
        ));
    }
}
