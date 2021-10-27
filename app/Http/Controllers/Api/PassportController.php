<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginValidation;
use App\Http\Requests\RegisterValidation;
use App\Services\PassportService;
class PassportController extends Controller
{
    protected $passportService;
    public function __construct(PassportService $passportService)
    {
        $this->passportService = $passportService;
    }
    public function register(RegisterValidation $request)
    {
        return $this->passportService->register($request);
    }
    public function login(LoginValidation $request)
    {
        return $this->passportService->login($request);
    }
}
