@extends('panel.layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Tambah Disposisi Surat</h1>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            @include('_message')
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Tambah Disposisi Surat</h5>
                    <form action="{{ url('panel/disposisiSurat/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="surat_id">Surat Eksternal</label>
                            <select class="form-control" id="surat_id" name="surat_id">
                                @foreach ($suratEksternal as $surat)
                                    <option value="{{ $surat->id }}">{{ $surat->judul_surat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <textarea class="form-control" id="catatan" name="catatan" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="roles_ids">Pilih Role Tujuan</label>
                            <select class="form-control" id="roles_ids" name="roles_ids[]" multiple>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="Belum Dibaca">Belum Dibaca</option>
                                <option value="Sedang Dikerjakan">Sedang Dikerjakan</option>
                                <option value="Sudah Dikerjakan">Sudah Dikerjakan</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
