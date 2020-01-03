<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert(array(
            array(
                'category_id' => 1,
                'name' => 'Flux AB',
                'url' => 'https://www.flux.nu/',
                'address' => 'Mallslingan 26, 187 66 Täby',
                'mobile' => "08-6930500",
                'opening_hours' => 'Må-Fr: 08.00 - 17.00 Besök endast efter tidsbokning!',
                'email' => 'info@flux.nu',
                'long_term_deals' => "10% på LED",
                'image_file_path' => 'flux.jpg'
            ),
            array(
                'category_id' => 2,
                'name' => 'Kakelhörnan Arninge',
                'url' => 'http://www.kakelhornan.se/',
                'address' => 'Hantverkarvägen 11, Arninge',
                'mobile' => '086300028',
                'opening_hours' => 'Vardagar 07:30 – 18:00 Lördag 10:00 – 15:00 Söndag 11:00 – 15:00',
                'email' => 'info@kakelkornan.se',
                'long_term_deals' => '',
                'image_file_path' => 'kakelhornan.jpg'),
            array(
                'category_id' => 3,
                'name' => 'K-rauta',
                'url' => 'https://www.k-rauta.se/byggvaruhus',
                'address' => 'Mätslingan 1, 187 66 Täby',
                'mobile' => '08 - 522 92 900',
                'opening_hours' => 'Vardagar: 06.30-20.00 Lördag: 09.00-18.00 Söndag: 09.00-18.00',
                'email' => 'kundtjanst@k-rauta.se',
                'long_term_deals' => '15% på kakel',
                'image_file_path' => 'k-rauta-logo.jpg'),
            array(
                'category_id' => 4,
                'name' => 'Täby-Tryck',
                'url' => 'http://tabytryck.se/',
                'address' => 'Enhagsvägen 9, TÄBY',
                'mobile' => '08 - 7588980',
                'opening_hours' => 'Onsdag	09:00–16:30 Torsdag	09:00–16:30 Fredag	09:00–16:30 Lördag Stängt Söndag	Stängt Måndag	09:00–16:30 Tisdag	09:00–16:30',
                'email' => 'info@tabytryck.se',
                'long_term_deals' => '',
                'image_file_path' => 'taby_tryckeri.gif'),
            array(
                'category_id' => 4,
                'name' => 'Blomsterlandet',
                'url' => 'http://tabytryck.se/',
                'address' => 'Täbyvägen 1',
                'mobile' => '073-8341977',
                'opening_hours' => 'Mån-Fre 8-18 Lör 10-16 Sön 11-15',
                'email' => 'Info@blomsterlandet.se',
                'long_term_deals' => '',
                'image_file_path' => 'Blomsterlandet.png')
        ));
    }
}
