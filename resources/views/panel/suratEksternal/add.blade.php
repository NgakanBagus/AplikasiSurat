@extends(('panel.layouts.app'))

@section('content')

<div class="pagetitle">
  <h1>Surat Eksternal</h1>
</div><!-- End Page Title -->

<section class="section">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <!-- General Form Elements -->
              <form action="" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
                <div class="row my-3">
                  <label for="judul_surat" class="col-sm-2 col-form-label">Judul Surat</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="judul_surat" id="judul_surat" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="file_surat" class="col-sm-2 col-form-label">File Upload</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="file_surat" accept=".pdf" name="file" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-12" style="text-align: right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
              </form><!-- End General Form Elements -->
            </div>
          </div>
        </div>
    </section>

@endsection