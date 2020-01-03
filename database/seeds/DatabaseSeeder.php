<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(array(
            UsersTableSeeder::class,
            CategoriesTableSeeder::class,
            CompaniesTableSeeder::class,
            ActivationCodeTableSeeder::class,
            OffersTableSeeder::class,
            UsedOffersTableSeeder::class,
            InformationTableSeeder::class
        ));

        Model::reguard();
    }
}
