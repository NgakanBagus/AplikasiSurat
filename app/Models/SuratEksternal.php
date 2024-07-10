<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratEksternal extends Model
{
    use HasFactory;

    protected $table = 'surat_eksternal';
    protected $fillable = ['judul_surat', 'file_name', 'file_path'];

    public function disposisi() {
        return $this->hasOne(DisposisiSurat::class);
    }
}
