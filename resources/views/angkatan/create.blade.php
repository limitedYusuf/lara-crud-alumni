@extends('layouts.app')

@section('content')
    <form action="{{ route('angkatan.store') }}" method="POST">
        @csrf

        <div class="card">
            <div class="card-header">
                Add Angkatan
            </div>

            <div class="card-body">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">{{ $message }}</div>
                @endif

                <div class="input">
                    <label for="">Nama Angkatan</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required>
                </div>

            </div>

            <div class="card-footer">
                <button class="btn btn-sm btn-primary" type="submit">{{ __('Submit') }}</button>
            </div>
        </div>

    </form>
@endsection
