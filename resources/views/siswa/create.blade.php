@extends('layouts.app')

@section('content')
    <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card">
            <div class="card-header">
                Add Siswa
            </div>

            <div class="card-body">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">{{ $message }}</div>
                @endif

                <div class="input mb-3">
                    <label for="">Nama Angkatan</label>
                    <select class="form-select @error('angkatan_id') is-invalid @enderror" name="angkatan_id" required>
                        <option value="">-- Pilih Angkatan --</option>
                        @foreach ($angkatan as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input mb-3">
                    <label for="">Nama Kelas</label>
                    <select class="form-select @error('kelas_id') is-invalid @enderror" name="kelas_id" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($kelas as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input mb-3">
                    <label for="">Nama Siswa</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required>
                </div>

                <div class="input mb-3">
                    <label for="">Foto Siswa</label>
                    <input class="form-control @error('foto') is-invalid @enderror" type="file" name="foto" required>
                </div>

                <div class="input mb-3">
                    <label for="">Info Kelahiran</label>
                    <input class="form-control @error('kelahiran') is-invalid @enderror" type="text" name="kelahiran"
                        required>
                </div>

                <div class="input">
                    <label for="">Link IG</label>
                    <input class="form-control @error('link') is-invalid @enderror" type="url" name="link" required>
                </div>

            </div>

            <div class="card-footer">
                <button class="btn btn-sm btn-primary" type="submit">{{ __('Submit') }}</button>
            </div>
        </div>

    </form>
@endsection