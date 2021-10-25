<?php

use App\Models\Analysis_results;
use Illuminate\Database\Seeder;

class Analysis_resultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $faker = factory(Analysis_results::class, 100)->create();
    }
}
