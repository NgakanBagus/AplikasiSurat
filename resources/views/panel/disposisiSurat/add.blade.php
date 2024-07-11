@extends(('panel.layouts.app'))

@section('content')

<div class="pagetitle">
  <h1>Disposisi Surat</h1>
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
                  <label for="surat_eksternal" class="col-sm-12 col-form-label">Surat Eksternal</label>
                  <div class="col-sm-12">
                    <select class="form-control" name="surat_id" id="surat_eksternal" required>
                      <option value="">Pilih Surat Eksternal</option>
                      @foreach($suratEksternal as $value)
                      <option {{ (old('surat_id') == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->judul_surat }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="row my-3">
                  <label for="roles" class="col-sm-12 col-form-label">Role Tujuan</label>
                  <div class="col-sm-12">
                    <select class="form-select" multiple name="roles_ids[]" id="roles" required>
                      @foreach($roles as $value)
                      <option {{ (old('roles_ids') == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="row my-3">
                  <label for="catatan" class="col-sm-2 col-form-label">Catatan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="catatan" id="catatan" required>
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