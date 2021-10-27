<?php

namespace App\Services;

use App\Core\Service;
use App\Repositories\ResultFileRepository;
use App\Repositories\ResultRepository;

class ResultFileService extends Service
{
    public function __construct(ResultFileRepository $repository)
    {
        $this->repository = $repository;
    }
}


?>
