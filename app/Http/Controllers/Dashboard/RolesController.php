<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Permission;
use Laratrust\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use App\Models\Role;
use App\Models\userLog;
class RolesController
{
    public $path = "dashboard.roles";
    protected $rolesModel;
    protected $permissionModel;

    public function __construct()
    {
        $this->rolesModel = Role::class;
        $this->permissionModel = Permission::class;
    }

    public function index()
    {
        return View::make($this->path.'.index', [
            'roles' => $this->rolesModel::withCount('permissions')
                ->simplePaginate(10),
        ]);
    }

    public function create()
    {
        return View::make('dashboard.roles.edit', [
            'model' => null,
            'permissions' => $this->permissionModel::all(['id', 'name']),
            'type' => 'role',
        ]);
    }

    public function show(Request $request, $id)
    {
        $role = $this->rolesModel::query()
            ->with('permissions:id,name,display_name')
            ->findOrFail($id);

        return View::make('dashboard.roles.show', ['role' => $role]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:roles,name',
            'display_name' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $role = $this->rolesModel::create($data);
        $role->syncPermissions($request->get('permissions') ?? []);
        userLog::create([
            'user_name'=>Auth('admin')->user()->name,
            'user_id'=>Auth('admin')->user()->id,
            'columnAction'=>$data['display_name'],
            'logMessage'=>"تم انشاء لائحة  بواسطة" . Auth('admin')->user()->name,
                  ]);
        Session::flash('laratrust-success', 'Role created successfully');
        return redirect()->back();
    }

    public function edit($id)
    {
        $role = $this->rolesModel::query()
            ->with('permissions:id')
            ->findOrFail($id);

        if (!Helper::roleIsEditable($role)) {
            Session::flash('laratrust-error', 'The role is not editable');
            return redirect()->back();
        }

        $permissions = $this->permissionModel::all(['id', 'name', 'display_name'])
            ->map(function ($permission) use ($role) {
                $permission->assigned = $role->permissions
                    ->pluck('id')
                    ->contains($permission->id);

                return $permission;
            });

        return View::make($this->path.'.edit', [
            'model' => $role,
            'permissions' => $permissions,
            'type' => 'role',
        ]);
    }

    public function update(Request $request, $id)
    {
        $role = $this->rolesModel::findOrFail($id);

        if (!Helper::roleIsEditable($role)) {
            Session::flash('laratrust-error', 'The role is not editable');
            return redirect()->route('dashboard.laratrust.roles.index');
        }

        $data = $request->validate([
            'display_name' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $role->update($data);
        $role->syncPermissions($request->get('permissions') ?? []);
        userLog::create([
            'user_name'=>Auth('admin')->user()->name,
            'user_id'=>Auth('admin')->user()->id,
            'columnAction'=> auth('admin')->user()->name,
            'logMessage'=>"تم تحديث لائحة  بواسطة" . Auth('admin')->user()->name,
                  ]);
        Session::flash('laratrust-success', 'Role updated successfully');
        return redirect()->back();

    }

    public function destroy($id)
    {
        $role = $this->rolesModel::findOrFail($id);
        $this->rolesModel::destroy($id);
        userLog::create([
            'user_name'=>Auth('admin')->user()->name,
            'user_id'=>Auth('admin')->user()->id,
            'columnAction'=> auth('admin')->user()->name,
            'logMessage'=>"تم ازالة لائحة  بواسطة" . Auth('admin')->user()->name,
                  ]);
        return redirect()->back();
    }
}
