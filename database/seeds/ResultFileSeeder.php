<?php

use App\Models\ResultFile;
use Illuminate\Database\Seeder;

class ResultFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ResultFile::class, 100)->create();
    }
}
