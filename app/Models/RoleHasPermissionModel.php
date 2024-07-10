<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleHasPermissionModel extends Model
{
    use HasFactory;

    protected $table = 'role_has_permission';

    static public function InsertUpdateRecord($permission_ids, $role_id)
    {
        RoleHasPermissionModel::where('role_id', '=', $role_id)->delete();
        foreach($permission_ids as $permission_id)
        {
            $save = new RoleHasPermissionModel;
            $save->permission_id = $permission_id;
            $save->role_id = $role_id;
            $save->save();
        }
    }

    static public function getRolePermission($role_id)
    {
        return RoleHasPermissionModel::where('role_id', '=', $role_id)->get();
    }

    static public function getPermission($slug, $role_id)
    {
        return RoleHasPermissionModel::select('role_has_permission.id')
        ->join('permission', 'permission.id', '=', 'role_has_permission.permission_id')
        ->where('role_has_permission.role_id', '=', $role_id)
        ->where('permission.slug', '=', $slug)
        ->count();
    }
}
