<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratEksternal;
use Illuminate\Support\Facades\Auth;
use App\Models\RoleHasPermissionModel;
use App\Models\RoleModel;

class SuratEksternalController extends Controller
{
    public function showAll() {
        $PermissionRoles = RoleHasPermissionModel::getPermission('Surat Eksternal', Auth::user()->role_id);
        if(empty($PermissionRoles))
        {
            abort(401);
        }

        $data['PermissionAdd'] = RoleHasPermissionModel::getPermission('Add Surat Eksternal', Auth::user()->role_id); 
        $data['PermissionEdit'] = RoleHasPermissionModel::getPermission('Edit Surat Eksternal', Auth::user()->role_id); 
        $data['PermissionDelete'] = RoleHasPermissionModel::getPermission('Delete Surat Eksternal', Auth::user()->role_id); 

        $data['suratEksternal'] = SuratEksternal::orderBy('created_at', 'desc')->get();
        return view('panel.suratEksternal.list', $data);
    }

    public function showAddForm() {
        $PermissionRoles = RoleHasPermissionModel::getPermission('Add Surat Eksternal', Auth::user()->role_id);
        if(empty($PermissionRoles)) {
            abort(401);
        }
    
        $roles = RoleModel::all(); // Adjust this to fetch your roles data
    
        return view('panel.suratEksternal.add', ['roles' => $roles]);
    }
    

    public function store(Request $request)
    {
        $PermissionRoles = RoleHasPermissionModel::getPermission('Add Surat Eksternal', Auth::user()->role_id);
        if(empty($PermissionRoles))
        {
            abort(401);
        }

        if ($request->file()) {
            $request->validate([
                'file' => 'required|mimes:pdf|max:2048',
            ]);

            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');

            $suratEksternal = new SuratEksternal();
            $suratEksternal->judul_surat = $request->judul_surat;
            $suratEksternal->file_name = $fileName;
            $suratEksternal->file_path = '/storage/' . $filePath;
            $suratEksternal->save();

            return redirect('panel/suratEksternal')->with('success', "Surat eksternal berhasil dibuat");
        }

        abort(401);
    }

    public function showSurat($id) {
        $surat = SuratEksternal::findOrFail($id);
        return response()->file(storage_path('app\public\uploads\\' . $surat->file_name));
    }

    public function showEditForm($id) {
        $PermissionRoles = RoleHasPermissionModel::getPermission('Edit Surat Eksternal', Auth::user()->role_id);
        if(empty($PermissionRoles))
        {
            abort(401);
        }

        $surat = SuratEksternal::findOrFail($id);

        return view('panel.suratEksternal.edit', ['surat' => $surat]);
    }

    public function edit($id, Request $request) {
        $PermissionRoles = RoleHasPermissionModel::getPermission('Edit Surat Eksternal', Auth::user()->role_id);
        if(empty($PermissionRoles))
        {
            abort(401);
        }

        $suratEksternal = SuratEksternal::findOrFail($id);
        $suratEksternal->judul_surat = $request->judul_surat;

        if ($request->file()) {
            $request->validate([
                'file' => 'required|mimes:pdf|max:2048',
            ]);
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');

            $suratEksternal->file_name = $fileName;
            $suratEksternal->file_path = '/storage/' . $filePath;

            // TODO: Hapus file surat lama?

        }

        $suratEksternal->save();
        return redirect('panel/suratEksternal')->with('success', "Surat eksternal berhasil diedit");
    }

    public function delete($id) {
        $PermissionRoles = RoleHasPermissionModel::getPermission('Delete Surat Eksternal', Auth::user()->role_id);
        if(empty($PermissionRoles))
        {
            abort(401);
        }

        $suratEksternal = SuratEksternal::findOrFail($id);
        $suratEksternal->delete();

        // TODO: Hapus file surat

        return redirect('panel/suratEksternal')->with('success', "Surat Eksternal Succesfully Deleted");
    }
}
