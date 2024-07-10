<?php

namespace App\Http\Controllers;

use App\Models\RoleModel;
use Illuminate\Http\Request;
use App\Models\DisposisiSurat;
use App\Models\SuratEksternal;
use Illuminate\Support\Facades\Auth;
use App\Models\RoleHasPermissionModel;

class DisposisiSuratController extends Controller
{
    public function showAll() {
        $PermissionRoles = RoleHasPermissionModel::getPermission('Disposisi', Auth::user()->role_id);
        if(empty($PermissionRoles)) {
            abort(401);
        }

        $data['PermissionAdd'] = RoleHasPermissionModel::getPermission('Add Disposisi', Auth::user()->role_id); 
        $data['PermissionEdit'] = RoleHasPermissionModel::getPermission('Edit Disposisi', Auth::user()->role_id); 
        $data['PermissionDelete'] = RoleHasPermissionModel::getPermission('Delete Disposisi', Auth::user()->role_id);

        if(Auth::user()->role_id == 3 || Auth::user()->role_id == 1) {
            $data['disposisiSurat'] = DisposisiSurat::with('suratEksternal')->orderBy('created_at', 'desc')->get(); // Retrieve semua jika kepala desa / admin
        } else {
            $data['disposisiSurat'] = DisposisiSurat::whereHas('roleDestination', function ($query) {
                $query->where('role_id', Auth::user()->role_id);
              })
              ->orderBy('created_at', 'desc')
              ->get();
        }

        return view('panel.disposisiSurat.list', $data);
    }

    public function showAddForm() {
        $PermissionRoles = RoleHasPermissionModel::getPermission('Add Disposisi', Auth::user()->role_id);
        if(empty($PermissionRoles)) {
            abort(401);
        }

        $suratTerdisposisi = DisposisiSurat::pluck('surat_id');
        $suratEksternal = SuratEksternal::whereNotIn('id', $suratTerdisposisi)->get();
        $roles = RoleModel::getRecord();

        return view('panel.disposisiSurat.add', ['suratEksternal' => $suratEksternal, 'roles' => $roles]);
    }

    public function showEditForm($id) {
        $PermissionRoles = RoleHasPermissionModel::getPermission('Edit Disposisi', Auth::user()->role_id);
        if (empty($PermissionRoles)) {
            abort(401);
        }

        $disposisiSurat = DisposisiSurat::findOrFail($id);
        $suratEksternal = SuratEksternal::all();
        $roles = RoleModel::all();

        return view('panel.disposisiSurat.edit', compact('disposisiSurat', 'suratEksternal', 'roles'));
    }

    public function edit(Request $request, $id) {
        $PermissionRoles = RoleHasPermissionModel::getPermission('Edit Disposisi', Auth::user()->role_id);
        if (empty($PermissionRoles)) {
            abort(401);
        }

        $request->validate([
            'catatan' => 'required',
            'surat_id' => 'required',
            'file' => 'nullable|mimes:pdf|max:2048',
            'status' => 'required|in:Belum Dibaca,Sedang Dikerjakan,Sudah Dikerjakan',
        ]);

        $disposisiSurat = DisposisiSurat::findOrFail($id);
        $disposisiSurat->catatan = $request->catatan;
        $disposisiSurat->surat_id = $request->surat_id;
        $disposisiSurat->status = $request->status;

        if ($request->file('file')) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            $disposisiSurat->file_name = $fileName;
            $disposisiSurat->file_path = '/storage/' . $filePath;
        }

        $disposisiSurat->save();

        return redirect()->route('panel.disposisiSurat')->with('success', 'Disposisi surat berhasil diedit');
    }

    public function store(Request $request) {
        $PermissionRoles = RoleHasPermissionModel::getPermission('Add Disposisi', Auth::user()->role_id);
        if(empty($PermissionRoles)) {
            abort(401);
        }

        $request->validate([
            'catatan' => 'required',
            'surat_id' => 'required',
            'status' => 'required|in:Belum Dibaca,Sedang Dikerjakan,Sudah Dikerjakan',
        ]);

        $disposisiSurat = new DisposisiSurat();
        $disposisiSurat->catatan = $request->catatan;
        $disposisiSurat->surat_id = $request->surat_id;
        $disposisiSurat->status = $request->status;
        
        $disposisiSurat->save();
        
        $disposisiSurat->roleDestination()->attach($request->roles_ids);
        
        return redirect('panel/disposisiSurat')->with('success', "Disposisi surat berhasil dibuat");
    }

    public function delete($id) {
        $PermissionRoles = RoleHasPermissionModel::getPermission('Delete Disposisi', Auth::user()->role_id);
        if (empty($PermissionRoles)) {
            abort(401);
        }

        $disposisiSurat = DisposisiSurat::findOrFail($id);

        // Hapus relasi many-to-many sebelum menghapus DisposisiSurat
        $disposisiSurat->roleDestination()->detach();
        $disposisiSurat->delete();

        return redirect('panel/disposisiSurat')->with('success', "Disposisi Surat berhasil dihapus");
    }

    public function updateStatus(Request $request, $id) {
        $PermissionRoles = RoleHasPermissionModel::getPermission('Edit Disposisi', Auth::user()->role_id);
        if (empty($PermissionRoles)) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
    
        $disposisiSurat = DisposisiSurat::findOrFail($id);
        $status = $request->status;
    
        if (in_array($status, ['Belum Dibaca', 'Sedang Dikerjakan', 'Sudah Dikerjakan', 'Sudah Dibaca'])) {
            $disposisiSurat->status = $status;
            $disposisiSurat->save();
    
            return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui']);
        }
    
        return response()->json(['success' => false, 'message' => 'Status tidak valid'], 400);
    }    
    
}

