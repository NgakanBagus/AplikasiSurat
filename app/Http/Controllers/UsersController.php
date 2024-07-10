<?php

namespace App\Http\Controllers;

use App\Models\RoleHasPermissionModel;
use Illuminate\Http\Request;
use App\Models\RoleModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function users()
    {
        $PermissionRoles = RoleHasPermissionModel::getPermission('Users', Auth::user()->role_id);
        if(empty($PermissionRoles))
        {
            abort(401);
        }

        $data['PermissionAdd'] = RoleHasPermissionModel::getPermission('Add Users', Auth::user()->role_id); 
        $data['PermissionEdit'] = RoleHasPermissionModel::getPermission('Edit Users', Auth::user()->role_id); 
        $data['PermissionDelete'] = RoleHasPermissionModel::getPermission('Delete Users', Auth::user()->role_id); 
        
        $data['getRecord'] = User::getRecord();
        return view('panel.users.list', $data);
    }

    public function add()
    {
        $PermissionRoles = RoleHasPermissionModel::getPermission('Add Users', Auth::user()->role_id);
        if(empty($PermissionRoles))
        {
            abort(401);
        }
        
        $data['getRole'] = RoleModel::getRecord();
        return view('panel.users.add', $data);
    }

    public function insert(Request $request)
    {
        $PermissionRoles = RoleHasPermissionModel::getPermission('Add Users', Auth::user()->role_id);
        if(empty($PermissionRoles))
        {
            abort(401);
        }

        request()->validate([
            'email' => 'required|email|unique:users',
        ]);

        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->role_id = trim($request->role_id);
        $user->save();

        return redirect('panel/users')->with('success', "User Successfully Created");

    }

    public function edit($id)
    {
        $PermissionRoles = RoleHasPermissionModel::getPermission('Edit Users', Auth::user()->role_id);
        if(empty($PermissionRoles))
        {
            abort(401);
        }
        
        $data['getRecord'] = User::getSingle($id);
        $data['getRole'] = RoleModel::getRecord();
        return view('panel.users.edit', $data);
    }

    public function update($id, Request $request)
    {
        $PermissionRoles = RoleHasPermissionModel::getPermission('Edit Users', Auth::user()->role_id);
        if(empty($PermissionRoles))
        {
            abort(401);
        }

        $user = User::getSingle($id);
        $user->name = trim($request->name);
        if(!empty($request->password))
        {
            $user->password = Hash::make($request->password);
        }
        $user->role_id = trim($request->role_id);
        $user->save();

        return redirect('panel/users')->with('success', "User Successfully Updated");
    }

    public function delete($id)
    {
        $PermissionRoles = RoleHasPermissionModel::getPermission('Delete Users', Auth::user()->role_id);
        if(empty($PermissionRoles))
        {
            abort(401);
        }
        
        $save = User::getSingle($id);
        $save->delete();

        return redirect('panel/users')->with('success', "User Succesfully Deleted");
    }
}
