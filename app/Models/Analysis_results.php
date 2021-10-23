<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Analysis_results extends Model
{
    protected $fillable = [
      'org_name', 'service_name', 'reg_date', 'result_date', 'status', 'user_id'
    ];
    public function files()
    {
        return $this->hasMany(Result_files::class, 'result_id', 'id');
    }
}
