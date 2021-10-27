<?php

namespace App\Services;

use App\Core\Service;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class PassportService extends Service
{
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function register($request)
    {
        $msg = 'This user has already registered';
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $user = $this->get()->where('phone', $data['phone'])->where('reg_status', 0)->first();
        $userReg = $this->get()->where('phone', $data['phone'])->where('reg_status', 1)->first();
        if ($user) {
            $data['reg_status'] = 1;
            $this->edit($user->id, $data);
            $msg = 'The user has successfully registered';
            $token = $user->createToken('authToken')->accessToken;
            return response()->successJson($token, $msg);
        }
        else if($userReg) return response()->successJson($msg);
        else{
            $data['reg_status'] = 1;
            $user = $this->create($data);
            $msg = 'The user has successfully registered';
            $token = $user->createToken('authToken')->accessToken;
            return response()->successJson($token, $msg);
        }
    }
    public function login($request)
    {
        $data = $request->validated();
        $msg = 'such a user does not exist';
        if(!Auth::attempt($data)) return response()->errorJson(401, $msg);
        else
        {
            $user = auth()->user();
            $msg = 'login was successful';
            $token = $user->createToken('authToken')->accessToken;
            return response()->successJson($token, $msg);
        }
    }
}


?>
