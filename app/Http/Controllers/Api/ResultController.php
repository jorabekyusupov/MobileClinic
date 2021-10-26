<?php

namespace App\Http\Controllers\Api;



use App\Http\Controllers\Controller;
use App\Http\Requests\ResultValidation;
use App\Models\AnalysisResult;
use App\Models\ResultFile;
use App\Models\User;
use App\Services\ResultService;
use App\Traits\FileUpload;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    use FileUpload;
    protected $service;
    protected $user;
    protected $result;
    public function __construct(ResultService $service)
    {
        $this->service = $service;
    }


    public function show(Request $request)
    {

        $this->result = $this->service->show($request->user_id, ['files']);

        return response()->successJson($this->result);
    }


    public function update(ResultValidation $request)
    {
        $data = $request->validated();
        $this->user = User::where('phone', $request->phone)->first();


        $this->result = AnalysisResult::where('id', $request->id)->first();
        if (!$this->result) {
            if (!$this->user) {
                $newuser = User::create([
                    'firstname' => $data['firstname'],
                    'lastname' => $data['lastname'],
                    'middlename' => $data['middlename'],
                    'phone' => $data['user_phone'],
                    'reg_status' => 0
                ]);
                $data['user_id'] = $newuser->id;
            } else {
                $data['user_id'] = $this->user->id;
            }
            $this->result = $this->service->create($data);
            if ($request->hasFile('files')) {
                $data = $this->FilesUpload($data, '/app/resultfiles/');

                ResultFile::create([
                    'description' => $data['files_description'],
                    'storagepath_name' => $data['files'],
                    'orginalname' => $data['files_orginalName'],
                    'result_id' => $this->result->id
                ]);
            }
            if ($this->result) {
                return response()->successJson('null', 'the created successfully');
            } else {
                return response()->errorJson(500, 'the not created');
            }
        } else {
            if ($request->user_id) {
                $this->result = $this->service->edit($request->id, $data);
                $files = ResultFile::where('result_id', $this->result->id)->first();


                if (!$files) {
                    if ($request->hasFile('files')) {
                        $data = $this->FilesUpload($data,  '/app/resultfiles/');
                        ResultFile::create([
                            'storagepath_name' => $data['files'],
                            'description' => $data['files_description'],
                            'orginalname' => $data['files_orginalName'],
                            'result_id' => $this->result->id,
                        ]);
                    }
                } else {

                    $data = $this->FilesUpload($data, '/app/resultfiles/');
                    $files->update([
                        'storagepath_name' => $data['files'],
                        'description' => $data['files_description'],
                        'orginalname' => $data['files_orginalName'],
                        'result_id' => $this->result->id,
                    ]);
                }
                if ($request->user_id) {
                    $user = User::where('id', $request->user_id)->first();

                    // dd($user);
                    $user->update($data);
                }
                if ($this->result) {
                    return response()->successJson('null', 'the updated successfully');
                } else {
                    return response()->errorJson(500, 'the not updated');
                }
            }
        }
    }
}
