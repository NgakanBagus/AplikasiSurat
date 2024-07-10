@extends(('panel.layouts.app'))

@section('content')
    <div class="pagetitle">
        <h1>Tambah User</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-10">

                <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tambah User</h5>

                    <form action="" method="POST">
                        {{ csrf_field() }}
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Nama</label>
                            <div class="col-sm-12">
                            <input type="text" name="name" value="{{ old('name') }}" required class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Email</label>
                            <div class="col-sm-12">
                            <input type="email" name="email" value="{{ old('email') }}" required class="form-control">
                            <div style="color: red">{{ $errors->first('email') }}</div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Password</label>
                            <div class="col-sm-12">
                            <input type="password" name="password" required class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Roles</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="role_id" required>
                                    <option value="">Pilih Role</option>
                                    @foreach($getRole as $value)
                                    <option {{ (old('role_id') == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-12" style="text-align: right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
                </div>

            </div>
        </div>
    </section>

@endsection