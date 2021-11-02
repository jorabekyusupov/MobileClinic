<?php

namespace App\Services;

use App\Core\Service;
use App\Repositories\ResultRepository;
use App\Traits\FileUpload;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;

class ResultActionService extends Service
{
    use FileUpload;
    public function __construct(ResultRepository $repository, ResultFileService $resultFileService, UserService $userService)
    {
        $this->ResultFileService = $resultFileService;
        $this->UserService = $userService   ;
        $this->repository = $repository;
    }
    public function store($user, $result, $data, $request)
    {
        if (!$user) {
            $data['phone'] = $data['user_phone'];
            $data['reg_status'] = 0;
            $NewUser = $this->UserService->create($data);
            $data['user_id'] = $NewUser->id;
        } else {
            $data['user_id'] = $user->id;
        }
        $result = $this->create($data);
        if ($request->hasFile('files')) {
            $data = $this->FilesUpload($data, '/app/resultfiles/', $result->id);
        }
        if ($result)
            return response()->successJson(null,201, 'the created successfully');
        else
            return response()->errorJson(null,500, 'the not created');
    }
    public function update($user, $result, $data, $request)
    {
        if ($request->user_id) {
            $result = $this->edit($request->id, $data);
            $files = $this->ResultFileService->get()->where('result_id', $result->id)->first();
            if (!$files) {
                if ($request->hasFile('files')) {
                    $data = $this->FilesUpload($data,  '/app/resultfiles/');
                    $data['result_id'] = $result->id;
                    $this->ResultFileService->create($data);
                }
            } else {
                $data = $this->FilesUpload($data, '/app/resultfiles/');
                $data['result_id'] = $result->id;
                $this->ResultFileService->edit($files->id, $data);
            }
            if ($request->user_id) {
                $user = $this->UserService->get()->where('id', $request->user_id)->first();
                $this->UserService->edit($user->id,$data);
            }
            if ($result) {
                return response()->successJson(null, 200, 'the updated successfully');
            } else {
                return response()->errorJson(null,500, 'the not updated');
            }
        }
    }
  
}
