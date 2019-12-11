<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin;
use App\Services\Contracts\UserServiceContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Gate;
use Log;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserServiceContract $userService)
    {
        $this->userService = $userService;
    }

    public function users()
    {
        $users = $this->userService->get();
        return view('admin.modules.users.index', compact('users'));
    }

    public function register(Request $request)
    {
        try {
            $user = $this->userService->store([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);
        } catch (Exception $e) {
            Log::debug($e);
        }
    }
}
