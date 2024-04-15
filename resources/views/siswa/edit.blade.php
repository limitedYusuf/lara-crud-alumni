@extends('layouts.app')

@section('content')
    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-header">
                Edit Alumni
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
                            <option value="{{ $item->id }}" {{ $item->id == $siswa->angkatan_id ? 'selected' : '' }}>
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input mb-3">
                    <label for="">Nama Kelas</label>
                    <select class="form-select @error('kelas_id') is-invalid @enderror" name="kelas_id" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($kelas as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $siswa->kelas_id ? 'selected' : '' }}>
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input mb-3">
                    <label for="">Nama Alumni</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                        value="{{ $siswa->name }}" required>
                </div>

                <div class="input mb-3">
                    <label for="">Foto Alumni (Opsional)</label>
                    <input class="form-control @error('foto') is-invalid @enderror" type="file" name="foto">
                </div>

                <div class="input mb-3">
                    <label for="">Info Kelahiran</label>
                    <input class="form-control @error('kelahiran') is-invalid @enderror" type="text" name="kelahiran"
                        value="{{ $siswa->kelahiran }}" required>
                </div>

                <div class="input mb-3">
                    <label for="">Link IG</label>
                    <input class="form-control @error('link') is-invalid @enderror" type="url" name="link"
                        value="{{ $siswa->link }}" required>
                </div>

                <div class="input">
                    <label for="">Link Dikti Siswa (https://pddikti.kemdikbud.go.id/)<br><p class="text-danger">Jika tidak terdaftar, kosongkan saja!</p></label>
                    <input class="form-control @error('dikti') is-invalid @enderror" type="url" name="dikti" value="{{ $siswa->dikti }}">
                </div>

            </div>

            <div class="card-footer">
                <button class="btn btn-sm btn-primary" type="submit">{{ __('Update') }}</button>
            </div>
        </div>

    </form>
@endsection
