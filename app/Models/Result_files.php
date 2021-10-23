<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result_files extends Model
{
    protected $fillable = [
        'name', 'description', 'result_id', 'download_link','orginalname','storagepath_name'
    ];
    public function result()
    {
        return $this->belongsTo(Analysis_results::class, 'result_id', 'id');
    }
}
