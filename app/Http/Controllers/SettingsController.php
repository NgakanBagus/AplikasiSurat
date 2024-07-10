<?php

namespace App\Http\Controllers;

use App\Models\RoleHasPermissionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function settings()
    {
        $PermissionRoles = RoleHasPermissionModel::getPermission('Settings', Auth::user()->role_id);
        if(empty($PermissionRoles))
        {
            abort(401);
        }
        return view('panel.settings.index');
    }
}
