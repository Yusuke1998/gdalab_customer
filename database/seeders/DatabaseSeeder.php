<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\{
    User, Region, Commune, Customer
};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(2)->create();
        Region::factory(5)->create();
        Commune::factory(5)->create();
        Customer::factory(5)->create();
    }
}
