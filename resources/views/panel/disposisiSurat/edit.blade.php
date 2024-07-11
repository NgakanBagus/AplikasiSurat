@extends('panel.layouts.app')

@section('content')

<div class="pagetitle">
    <h1>Edit Disposisi Surat</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            @include('_message')
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('panel/disposisiSurat/edit/' . $disposisiSurat->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="surat_id" class="form-label">Judul Surat</label>
                            <select class="form-control" id="surat_id" name="surat_id">
                                @foreach ($suratEksternal as $surat)
                                    <option value="{{ $surat->id }}" {{ $disposisiSurat->surat_id == $surat->id ? 'selected' : '' }}>
                                        {{ $surat->judul_surat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea class="form-control" id="catatan" name="catatan">{{ $disposisiSurat->catatan }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="Belum Dibaca" {{ $disposisiSurat->status == 'Belum Dibaca' ? 'selected' : '' }}>Belum Dibaca</option>
                                <option value="Sedang Dikerjakan" {{ $disposisiSurat->status == 'Sedang Dikerjakan' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                                <option value="Sudah Dikerjakan" {{ $disposisiSurat->status == 'Sudah Dikerjakan' ? 'selected' : '' }}>Sudah Dikerjakan</option>
                                <option value="Sudah Dibaca" {{ $disposisiSurat->status == 'Sudah Dibaca' ? 'selected' : '' }}>Sudah Dibaca</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label">File (optional)</label>
                            <input class="form-control" type="file" id="file" name="file">
                            @if ($disposisiSurat->file_path)
                                <a href="{{ asset($disposisiSurat->file_path) }}" target="_blank">View current file</a>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="roles" class="form-label">Role Tujuan</label>
                            <select class="form-control" id="roles" name="roles_ids[]" multiple>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" 
                                        @if ($disposisiSurat->roleDestination->contains($role->id)) selected @endif>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
