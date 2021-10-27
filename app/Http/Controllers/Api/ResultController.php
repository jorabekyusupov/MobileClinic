<?php

namespace App\Http\Controllers\Api;



use App\Http\Controllers\Controller;
use App\Http\Requests\ResultValidation;
use App\Http\Resources\ResultResource;
use App\Models\AnalysisResult;
use App\Models\ResultFile;
use App\Models\User;
use App\Services\ResultFileService;
use App\Services\ResultService;
use App\Services\UserService;
use App\Traits\FileUpload;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    use FileUpload;
    protected $ResultService, $ResultFileService, $UserService, $user, $result;
    public function __construct(ResultService $ResultService, ResultFileService $ResultFileService, UserService $UserService)
    {
        $this->ResultService = $ResultService;
        $this->ResultFileService = $ResultFileService;
        $this->UserService = $UserService;
    }
    public function show(Request $request)
    {
        $this->result = $this->ResultService->show($request->user_id, ['files', 'user']);
        $this->result = ResultResource::collection($this->result);
        return response()->successJson($this->result);
    }
    public function update(ResultValidation $request)
    {
        $data = $request->validated();
        $this->user = $this->UserService->get()->where('phone', request('user_phone'))->first();
        $this->result = $this->ResultService->get()->where('id', request('id'))->first();
        if (!$this->result) {
          return  $this->ResultService->store($this->user, $this->result, $data, $request);
        } else {
          return  $this->ResultService->update($this->user, $this->result, $data, $request);
        }
    }
}
