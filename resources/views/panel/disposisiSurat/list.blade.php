@extends('panel.layouts.app')

@section('content')

<div class="pagetitle">
    <h1>Disposisi Surat</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            @include('_message')
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title">Disposisi Surat List</h5>
                        </div>
                        <div class="col-md-6" style="text-align: right">
                            @if(!empty($PermissionAdd))
                            <a class="btn btn-primary" style="margin-top: 15px" href="{{ url('panel/disposisiSurat/add') }}">Tambah Disposisi Surat</a>
                            @endif
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Judul Surat</th>
                                <th scope="col">Nama File</th>
                                <th scope="col">Catatan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date</th>
                                @if(!empty($PermissionEdit) || !empty($PermissionDelete))
                                <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($disposisiSurat as $value)
                            <tr>
                                <td>{{ $value->suratEksternal->judul_surat }}</td>
                                <td>
                                    <a href="{{ url('panel/suratEksternal/showSurat/' .$value->suratEksternal->id) }}" target="_blank" onclick="markAsRead({{ $value->id }})">{{ $value->suratEksternal->file_name }}</a>
                                </td>
                                <td>{{ $value->catatan }}</td>
                                <td id="status-{{ $value->id }}">{{ $value->status }}</td>
                                <td>{{ $value->created_at }}</td>
                                @if(!empty($PermissionEdit) || !empty($PermissionDelete))
                                <td>
                                    @if(!empty($PermissionEdit))
                                        <a href="{{ url('panel/disposisiSurat/edit/' .$value->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        @if(Auth::user()->role_id != 3) <!-- Bukan Kepala Desa -->
                                            <button onclick="updateStatus({{ $value->id }}, 'Sedang Dikerjakan')" class="btn btn-info btn-sm">Kerjakan</button>
                                            <button onclick="updateStatus({{ $value->id }}, 'Sudah Dikerjakan')" class="btn btn-success btn-sm">Selesai</button>
                                        @endif
                                    @endif
                                    @if(!empty($PermissionDelete))
                                    <a href="#" class="btn btn-danger btn-sm" onclick="return confirmDelete('{{ $value->id }}')">Delete</a>
                                    @endif
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function markAsRead(id) {
            fetch(`{{ url('panel/disposisiSurat/updateStatus') }}/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: 'Sudah Dibaca' })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`status-${id}`).innerText = 'Sudah Dibaca';
                } else {
                    console.error('Error:', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function updateStatus(id, status) {
            fetch(`{{ url('panel/disposisiSurat/updateStatus') }}/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`status-${id}`).innerText = status;
                } else {
                    console.error('Error:', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function confirmDelete(id) {
            if (confirm("Apakah ingin menghapus file?")) {
                window.location.href = "{{ url('panel/disposisiSurat/delete/') }}" + "/" + id;
            }
        }
    </script>
</section>

@endsection
