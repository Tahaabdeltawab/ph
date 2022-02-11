<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\UpdatePermissionsRequest;
use App\Http\Resources\PermissionResource;
use App\Models\Permission;

class PermissionsController extends APIBaseController
{
    protected $permissionRepository;

    public function __construct()
    {
        $this->middleware('permission:create-permissions')->only(['store']);
        $this->middleware('permission:update-permissions')->only(['update']);
        $this->middleware('permission:delete-permissions')->only(['destroy']);
        $this->middleware('permission:show-permissions')->only(['show', 'index']);
    }

    public function index()
    {
        try{
            if(request()->type == 'options')
            $permissions = Permission::select(['id', 'name'])->get()->pluck('name', 'id');
            else
            $permissions = PermissionResource::collection(Permission::all());
            return $this->sendResponse($permissions);
        }catch(\Throwable $th){
            return $this->sendError($th->getMessage(), 500);
        }
    }


    public function store(UpdatePermissionsRequest $request)
    {
        try{
            $permission = Permission::create([
                'name'          => $request->name,
                'display_name'  => $request->display_name,
                'description'   => $request->description,
            ]);

            return $this->sendResponse(new PermissionResource($permission), 'Permission created successfully');

        }catch(\Throwable $th){
            return $this->sendError($th->getMessage(), 500);
        }
    }


    public function update(int $id, UpdatePermissionsRequest $request)
    {
        try{
            $permission = Permission::findOrFail($id);
            $permission->update([
                'name'          => $request->name,
                'display_name'  => $request->display_name,
                'description'   => $request->description,
            ]);
            return $this->sendResponse(new PermissionResource(Permission::find($id)), 'Permission updated successfully');
        }catch(\Throwable $th){
            return $this->sendError($th->getMessage(), 500);
        }


    }

    public function show(int $id)
    {
        try{
            $permission = Permission::findOrFail($id);
                return $this->sendResponse(new PermissionResource($permission), 'Permission retrived successfully');
        }catch(\Throwable $th){
            return $this->sendError($th->getMessage(), 500);
        }

    }

    public function destroy(int $id)
    {
        try{
            $permission = Permission::findOrFail($id);
                $permission->delete();
            return $this->sendResponse(new PermissionResource($permission), 'Permission deleted successfully');
        }catch(\Throwable $th){
            return $this->sendError($th->getMessage(), 500);
        }
    }
}
