<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResultValidation;
use App\Http\Resources\ResultResource;
use App\Services\ResultFileService;
use App\Services\ResultService;
use App\Services\UserService;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    use FileUpload;

    protected $ResultService, $ResultFileService, $UserService, $user, $result, $authUser;

    public function __construct(
        ResultService $ResultService,
        ResultFileService $ResultFileService,
        UserService $UserService
    ) {
        $this->ResultService = $ResultService;
        $this->ResultFileService = $ResultFileService;
        $this->UserService = $UserService;
    }

    public function show($result_id)
    {
        $this->result = $this->ResultService->singleShow($result_id);
        if ($this->result) {
            return response()->successJson($this->result, 200);
        } else {
            return response()->errorJson(500);
        }
    }

    public function list()
    {
        $this->authUser = Auth::user()->id;
        $this->result = $this->ResultService->show($this->authUser, ['files']);
        $this->result = ResultResource::collection($this->result);
        if ($this->result) {
            return response()->successJson($this->result, 200);
        } else {
            return response()->errorJson(500);
        }
    }

    public function update(ResultValidation $request)
    {
        return $this->ResultService->StoreAction($request);
    }

    public function FileDownload($file_id)
    {
        return $this->ResultService->getFile($file_id);
    }

    public function hello()
    {
        return "Hello world";
    }
}
