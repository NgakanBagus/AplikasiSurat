<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisposisiSurat extends Model
{
    use HasFactory;
    protected $table = 'disposisi_surat';

    protected $fillable = [
        'catatan',
        'status'
    ];

    public function suratEksternal() {
        return $this->belongsTo(SuratEksternal::class, 'surat_id');
    }

    public function roleDestination() {
        return $this->belongsToMany(RoleModel::class, 'role_disposisi', 'disposisi_id', 'role_id');
    }
}
