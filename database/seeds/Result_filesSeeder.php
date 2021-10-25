<?php

use App\Models\Result_files;
use Illuminate\Database\Seeder;

class Result_filesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = factory(Result_files::class, 100)->create();
    }
}
