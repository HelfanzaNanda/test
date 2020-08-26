@extends('templates.default') @section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Bank</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form
                            action="{{ route('bank.update', $data->id) }}"
                            method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label>Nama Bank</label>
                                <input
                                    type="text" name="bank_name" value="{{ $data->bank_name }}"
                                    class="form-control @error('bank_name') is-invalid @enderror">
                                @error('bank_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Logo</label>
                                <input type="file" class="@error('logo') is-invalid @enderror dropify" 
                                name="logo" data-default-file="{{ $data->logo }}"/>
                                @error('logo')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input
                                    type="text"
                                    name="contact_email" value="{{ $data->contact_email }}"
                                    class="form-control @error('contact_email') is-invalid @enderror">
                                @error('contact_email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-action">
                                <button type="submit" class="btn btn-success btn-sm">simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection