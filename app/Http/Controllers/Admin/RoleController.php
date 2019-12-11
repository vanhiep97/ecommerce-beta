<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Services\Contracts\RoleServiceContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Log;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleServiceContract $roleService)
    {
        $this->roleService = $roleService;
    }

    public function roles()
    {
        $roles = $this->roleService->get();
        return view('admin.modules.roles.index', compact('roles'));
    }

    public function updateStatus(Request $request)
    {
        try {
            $role = $this->roleService->find($request->role_id);
            $role->status = $request->status;
            $role->save();
            return response()->json(['result' => $role]);
        } catch (Exception $e) {
            Log::debug($e);
            return response()->json(false);
        }
    }

    public function create()
    {
        return view('admin.modules.roles.create');
    }

    public function store(RoleCreateRequest $request)
    {
        try {
            $roles = $this->roleService->store([
                'name' => $request->name,
                'label' => $request->label,
                'description' => $request->description,
                'status' => $request->status,
                'admin_create' => Auth::user()->name,
            ]);
            return response()->json([
                'result' => $roles,
                'status' => true,
            ]);
        } catch (Exception $e) {
            Log::debug($e);
        }
    }

    public function edit($id)
    {
        $role = $this->roleService->find($id);
        return view('admin.modules.roles.edit', compact('role'));
    }

    public function update(RoleUpdateRequest $request)
    {
        try {
            $updated = $this->roleService->update($request->id,[
                'name' => $request->name,
                'label' => $request->label,
                'description' => $request->description,
                'status' => $request->status,
                'admin_create' => Auth::user()->name,
            ]);
            return response()->json([
                'result' => $updated,
            ]);
        } catch (Exception $e) {
            Log::debug($e);
            return response()->json(false);
        }
    }

    public function destroy($id) {
        try {
            $destroy = $this->roleService->destroy($id);
            return response()->json($destroy);
        } catch (Exception $e) {
            Log::debug($e);
            return response()->json(false);
        }
    }
}
