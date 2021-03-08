<?php

namespace App\Http\Controllers\Dashboard;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use App\Models\Permission;
use App\Models\userLog;
class PermissionsController
{
    protected $permissionModel, $name;

    public function __construct()
    {
        $this->name = "dashboard.permissions";
        $this->permissionModel = permission::class;
    }

    public function index()
    {
        return View::make($this->name.'.index', [
            'permissions' => $this->permissionModel::all(),
        ]);
    }

    public function edit($id)
    {
        $permission = $this->permissionModel::findOrFail($id);

        return View::make($this->name.'.edit', [
            'model' => $permission,
            'type' => 'permission',
        ]);
    }

    public function update(Request $request, $id)
    {
        $permission = $this->permissionModel::findOrFail($id);

        $data = $request->validate([
            'display_name' => 'required|string',
            'description' => 'required|string',
        ]);

        $permission->update($data);
        userLog::create([
            'user_name'=>Auth('admin')->user()->name,
            'user_id'=>Auth('admin')->user()->id,
            'columnAction'=>$data['display_name'],
            'logMessage'=>"تـم تعديل صلاحية بواسطة "   . auth('admin')->user()->name,
                  ]);
        Session::flash('laratrust-success', 'Permission updated successfully');
        return redirect()->route('dashboard.laratrust.permissions.index');
    }
}
