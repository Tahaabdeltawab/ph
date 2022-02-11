<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateRolesRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RolesController extends APIBaseController
{

    public function __construct()
    {
        $this->middleware('permission:create-roles')->only(['store']);
        $this->middleware('permission:update-roles')->only(['update']);
        $this->middleware('permission:delete-roles')->only(['destroy']);
        $this->middleware('permission:show-roles')->only(['show', 'index']);
    }

    public function index()
    {   try{
            if(request()->type == 'options')
            $roles = Role::select(['id', 'name'])->get()->pluck('name', 'id');
            else
            $roles = RoleResource::collection(Role::all());
            return $this->sendResponse($roles);
        }catch(\Throwable $th){
            return $this->sendError($th->getMessage(), 500);
        }
    }

    public function store(UpdateRolesRequest $request)
    {
        try{
            DB::beginTransaction();
            $role = Role::create([
                'name'          => $request->name,
                'display_name'  => $request->display_name,
                'description'   => $request->description,
            ]);

            if(isset($request->permissionsIds) && ! empty($request->permissionsIds))
                $role->syncPermissions($request->permissionsIds);
            DB::commit();
            return $this->sendResponse(new RoleResource($role), 'Role created successfully');
        }catch(\Throwable $th){
            DB::rollBack();
            return $this->sendError($th->getMessage(), 500);
        }

    }

    public function update(int $id, UpdateRolesRequest $request)
    {
        try{
            DB::beginTransaction();
            $role = Role::findOrFail($id);
            $role->update([
                'name'          => $request->name,
                'display_name'  => $request->display_name,
                'description'   => $request->description,
            ]);

            if (isset($request->permissionsIds))
                $role->syncPermissions($request->permissionsIds);

            DB::commit();
            return $this->sendResponse(new RoleResource(Role::find($id)), 'Role updated successfully');
        }catch(\Throwable $th){
            DB::rollBack();
            return $this->sendError($th->getMessage(), 500);
        }
    }

    public function show(int $id)
    {
        try{
            $role = Role::findOrFail($id);
                return $this->sendResponse(new RoleResource($role), 'Role retrived successfully');
        }catch(\Throwable $th){
            return $this->sendError($th->getMessage(), 500);
        }

    }

    public function destroy(int $id)
    {
        try{
            $role = Role::findOrFail($id);
                $role->delete();
            return $this->sendResponse(new RoleResource($role), 'Role deleted successfully');
        }catch(\Throwable $th){
            return $this->sendError($th->getMessage(), 500);
        }

    }

}
