<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultFile extends Model
{
    protected $fillable = [
        'name', 'description', 'result_id', 'download_link','orginalname','storagepath_name'
    ];
    public function result()
    {
        return $this->belongsTo(AnalysisResult::class, 'result_id', 'id');
    }
}
