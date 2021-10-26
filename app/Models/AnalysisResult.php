<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class AnalysisResult extends Model
{
    protected $fillable = [
        'organization_name', 'service_name', 'registration_date', 'result_date', 'status', 'user_id'
    ];

    public function files()
    {
        return $this->hasMany(ResultFile::class, 'result_id', 'id');
    }
}
