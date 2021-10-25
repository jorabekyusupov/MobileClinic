<?php


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
            // UserSeeder::class,
            Analysis_resultSeeder::class,
            Result_filesSeeder::class


         ]);
    }
}
