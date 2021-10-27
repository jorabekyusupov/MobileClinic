<?php

namespace App\Repositories;

use App\Core\Repository;

use App\Models\ResultFile;

class ResultFileRepository extends Repository
{
    public function __construct(ResultFile $model)
    {
        $this->model = $model;
    }



}


?>
