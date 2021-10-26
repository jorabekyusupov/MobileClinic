<?php

use App\Models\AnalysisResult;
use Illuminate\Database\Seeder;

class AnalysisResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(AnalysisResult::class, 100)->create();
    }
}
