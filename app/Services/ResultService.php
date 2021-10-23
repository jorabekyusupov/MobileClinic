<?php

namespace App\Services;

use App\Core\Service;
use App\Repositories\ResultRepository;

class ResultService extends Service
{
    public function __construct(ResultRepository $repository)
    {
        $this->repository = $repository;
    }
}


?>
