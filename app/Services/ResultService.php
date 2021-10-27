<?php

namespace App\Services;

use App\Core\Service;
use App\Repositories\ResultRepository;
use App\Traits\FileUpload;

class ResultService extends Service
{
    use FileUpload;

    protected $ResultFileService, $UserService, $ResultActionService;

    public function __construct(
        ResultRepository $repository,
        ResultFileService $resultFileService,
        UserService $userService,
        ResultActionService $resultActionService
    ) {
        $this->ResultFileService = $resultFileService;
        $this->UserService = $userService;
        $this->ResultActionService = $resultActionService;
        $this->repository = $repository;
    }

    public function StoreAction($request)
    {
        $data = $request->validated();
        $this->user = $this->UserService->get()->where('phone', request('user_phone'))->first();
        $this->result = $this->get()->where('id', request('id'))->first();
        if (!$this->result) {
            return $this->ResultActionService->store($this->user, $this->result, $data, $request);
        } else {
            return $this->ResultActionService->update($this->user, $this->result, $data, $request);
        }
    }

}
