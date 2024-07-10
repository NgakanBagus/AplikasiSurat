<?php

namespace App\Http\Controllers;

use App\Models\RoleHasPermissionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
    public function surat()
    {
        $PermissionRoles = RoleHasPermissionModel::getPermission('Surat', Auth::user()->role_id);
        if(empty($PermissionRoles))
        {
            abort(401);
        }
        return view('panel.surat.index');
    }
}
