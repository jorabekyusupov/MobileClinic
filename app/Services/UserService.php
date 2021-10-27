<?php

namespace App\Services;

use App\Core\Service;
use App\Repositories\UserRepository;

class UserService extends Service
{
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
}


?>
