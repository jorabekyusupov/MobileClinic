<?php

namespace App\Repositories;

use App\Core\Repository;
use App\Models\AnalysisResult;

class ResultRepository extends Repository
{
    public function __construct(AnalysisResult $model)
    {
        $this->model = $model;
    }
    public function show($id, $relation = null): object
    {
        $query = $this->query($relation);
        return $query->where('user_id', $id)->get();
    }


}


?>
