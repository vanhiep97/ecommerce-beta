<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Services\Layers\AuthService;
use Illuminate\Http\Request;
use Exception;
use Log;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login()
    {
        return view('admin.modules.auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        try {
            $logined = $this->authService->login([
                'email' => $request->email,
                'password' => $request->password,
            ]);
            return response()->json([
                'result' => $logined
            ]);
        } catch (Exception $e) {
            Log::debug($e);
            return response()->json(false);
        }
    }

    public function logout()
    {
        $logouted = $this->authService->logout();
        if ($logouted == true) {
            return redirect()->route('page-login');
        } else {
            return redirect(\URL::previous());
        }
    }
}
