<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(array(
            array('name' => 'El', 'image_file_path' => 'elbransch.jpg'),
            array('name' => 'Bygg', 'image_file_path' => 'byggbranch.jpg'),
            array('name' => 'Hus', 'image_file_path' => 'bostader.jpg'),
            array('name' => 'Trädgård', 'image_file_path' => 'Tradgard.jpg')
        ));
    }
}
