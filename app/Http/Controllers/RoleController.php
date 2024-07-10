<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleModel;
use App\Models\PermissionModel;
use App\Models\RoleHasPermissionModel;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function list()
    {
        $PermissionRoles = RoleHasPermissionModel::getPermission('Roles', Auth::user()->role_id);
        if(empty($PermissionRoles))
        {
            abort(401);
        }

        $data['PermissionAdd'] = RoleHasPermissionModel::getPermission('Add Roles', Auth::user()->role_id); 
        $data['PermissionEdit'] = RoleHasPermissionModel::getPermission('Edit Roles', Auth::user()->role_id); 
        $data['PermissionDelete'] = RoleHasPermissionModel::getPermission('Delete Roles', Auth::user()->role_id); 

        $data['getRecord'] = RoleModel::getRecord();
        return view('panel.role.list', $data);
     }

    public function add()
    {
        $PermissionRoles = RoleHasPermissionModel::getPermission('Add Roles', Auth::user()->role_id);
        if(empty($PermissionRoles))
        {
            abort(401);
        }

        $getPermission = PermissionModel::getRecord();
        $data['getPermission'] = $getPermission;

        return view('panel.role.add', $data);
     }

    public function insert(Request $request)
    {;
        $PermissionRoles = RoleHasPermissionModel::getPermission('Add Roles', Auth::user()->role_id);
        if(empty($PermissionRoles))
        {
            abort(401);
        }
        
        $save = new RoleModel;
        $save->name = $request->name;
        $save->save();

        RoleHasPermissionModel::InsertUpdateRecord($request->permission_id, $save->id);

        return redirect('panel/roles')->with('success', "Role Succesfully Created");
     }
    
    public function edit($id)
    {
        $PermissionRoles = RoleHasPermissionModel::getPermission('Edit Roles', Auth::user()->role_id);
        if(empty($PermissionRoles))
        {
            abort(401);
        }

        $data['getRecord'] = RoleModel::getSingle($id);
        $data['getPermission'] = PermissionModel::getRecord();
        $data['getRolePermission'] = RoleHasPermissionModel::getRolePermission($id);

        return view('panel.role.edit', $data);
    }

    public function update($id, Request $request)
    {
        $PermissionRoles = RoleHasPermissionModel::getPermission('Edit Roles', Auth::user()->role_id);
        if(empty($PermissionRoles))
        {
            abort(401);
        }
        
        $save = RoleModel::getSingle($id);
        $save->name = $request->name;
        $save->save();

        RoleHasPermissionModel::InsertUpdateRecord($request->permission_id, $save->id);

        return redirect('panel/roles')->with('success', "Role Succesfully Updated");
    }

    public function delete($id)
    {
        $PermissionRoles = RoleHasPermissionModel::getPermission('Delete Roles', Auth::user()->role_id);
        if(empty($PermissionRoles))
        {
            abort(401);
        }
        
        $save = RoleModel::getSingle($id);
        $save->delete();

        return redirect('panel/roles')->with('success', "Role Succesfully Deleted");
    }

}
