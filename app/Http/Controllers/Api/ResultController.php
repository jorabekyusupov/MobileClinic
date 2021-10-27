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
        return $this->ResultService->StoreAction($request);
    }
}
