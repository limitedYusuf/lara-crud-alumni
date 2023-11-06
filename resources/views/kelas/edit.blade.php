@extends('layouts.app')

@section('content')
    <form action="{{ route('kelas.update', $kela->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-header">
                Edit Kelas
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
                            <option value="{{ $item->id }}" {{ $item->id == $kela->angkatan_id ? 'selected' : '' }}>
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input">
                    <label for="">Nama Kelas</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                        value="{{ $kela->name }}" required>
                </div>

            </div>

            <div class="card-footer">
                <button class="btn btn-sm btn-primary" type="submit">{{ __('Update') }}</button>
            </div>
        </div>

    </form>
@endsection
