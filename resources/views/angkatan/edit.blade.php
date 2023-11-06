@extends('layouts.app')

@section('content')
    <form action="{{ route('angkatan.update', $angkatan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-header">
                Edit Angkatan
            </div>

            <div class="card-body">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">{{ $message }}</div>
                @endif

                <div class="input">
                    <label for="">Nama Angkatan</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                        value="{{ $angkatan->name }}" required>
                </div>

            </div>

            <div class="card-footer">
                <button class="btn btn-sm btn-primary" type="submit">{{ __('Update') }}</button>
            </div>
        </div>

    </form>
@endsection
