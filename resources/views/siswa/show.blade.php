@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            Detail Siswa (Alumni)
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">
                    <b>FOTO</b><br>
                    <img src="{{ Storage::url('siswa_foto/' . $data->foto) }}" width="200px" alt="">
                </li>
                <li class="list-group-item">
                    <b>NAMA</b><br>
                    <span>{{ $data->name }}</span>
                </li>
                <li class="list-group-item">
                    <b>ANGKATAN</b><br>
                    <span>{{ $data->angkatan->name }}</span>
                </li>
                <li class="list-group-item">
                    <b>KELAS</b><br>
                    <span>{{ $data->kelas->name }}</span>
                </li>
                <li class="list-group-item">
                    <b>Kelahiran</b><br>
                    <span>{{ $data->kelahiran }}</span>
                </li>
                <li class="list-group-item">
                    <b>Akun IG (Sosmed)</b><br>
                    <span><a href="{{ $data->link }}" target="_blank">{{ $data->link }}</a></span>
                </li>
            </ul>
        </div>
    </div>
@endsection
