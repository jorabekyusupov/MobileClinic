<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginValidation;
use App\Http\Requests\RegisterValidation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassportController extends Controller
{
    public function register(RegisterValidation $request)
    {
        $msg = 'This user has already registered';

        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $user = User::where('phone', $data['phone'])->where('reg_status', 0)->first();
        $userReg = User::where('phone', $data['phone'])->where('reg_status', 1)->first();


        if ($user) {

            $data['reg_status'] = 1;

            $user->update([
                'reg_status' => $data['reg_status'],
                'password' => $data['password']
            ]);
            $msg = 'The user has successfully registered';
            $token = $user->createToken('authToken')->accessToken;
            return response()->successJson($token, $msg);
        }
        else if($userReg){
            return response()->successJson($msg);
        }
        else{
            $data['reg_status'] = 1;
            $user = User::create($data);
            $msg = 'The user has successfully registered';
            $token = $user->createToken('authToken')->accessToken;
            return response()->successJson($token, $msg);
        }


    }
    public function login(LoginValidation $request)
    {
        $data = $request->validated();
        $msg = 'such a user does not exist';
        if(!Auth::attempt($data)) {
            return response()->errorJson(401, $msg);
        }
        else
        {
            $user = auth()->user();
            $msg = 'login was successful';
            $token = $user->createToken('authToken')->accessToken;
            return response()->successJson($token, $msg);
        }
    }
}
