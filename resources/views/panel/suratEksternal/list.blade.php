@extends(('panel.layouts.app'))

@section('content')

<div class="pagetitle">
    <h1>Surat Eksternal</h1>
  </div>

  <section class="section">
    <div class="row">

      <div class="col-lg-12">
        @include('_message')
        <div class="card">
          <div class="card-body">
            
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Surat Eksternal List</h5>
                </div>

                 <div class="col-md-6" style="text-align: right">
                    @if(!empty($PermissionAdd))
                    <a class="btn btn-primary" style="margin-top: 15px" href="{{ url('panel/suratEksternal/add') }}">Tambah Surat Eksternal</a>
                    @endif
                </div>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Judul Surat</th>
                    <th scope="col">Nama File</th>
                    <th scope="col">Date</th>
                    @if(!empty($PermissionEdit) || !empty($PermissionEdit))
                    <th scope="col">Action</th>
                    @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $suratEksternal as $value )
                        <tr>
                        <td>{{ $value->judul_surat }}</td>
                        <td>
                          <a href="{{ url('panel/suratEksternal/showSurat/' .$value->id) }}" target="_blank">{{ $value->file_name }}</a>
                        </td>
                        <td>{{ $value->created_at }}</td>
                        <td>
                          @if(!empty($PermissionEdit))
                            <a href="{{ url('panel/suratEksternal/edit/' .$value->id) }}" class="btn btn-primary btn-sm">Edit</a>
                          @endif
                          
                          @if(!empty($PermissionDelete))
                            <a href="#" class="btn btn-danger btn-sm" onclick="return confirmDelete('{{ $value->id }}')">Delete</a>
                          @endif
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

          </div>
        </div>

      </div>

    </div>

    <script>
      function confirmDelete(id) {
        const confirmBox = document.createElement("div");
        confirmBox.innerHTML = `
          <div class="confirm-box">
            <h2>Konfirmasi</h2>
            <p>Apakah ingin menghapus file?</p>
            <button class="btn btn-danger" onclick="deleteRecord(${id})">Delete</button>
            <button class="btn btn-secondary" onclick="cancelDelete()">Cancel</button>
          </div>
        `;
        document.body.appendChild(confirmBox);
      }

      function deleteRecord(id) {
        window.location.href = "{{ url('panel/suratEksternal/delete/') }}" + "/" + id;
      }

      function cancelDelete() {
        const confirmBox = document.querySelector(".confirm-box");
        confirmBox.remove();
      }
    </script>

<style>
  .confirm-box {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  }

  .confirm-box h2 {
    margin-top: 0;
  }

  .confirm-box button {
    margin-right: 10px;
  }
</style>

  </section>
@endsection">