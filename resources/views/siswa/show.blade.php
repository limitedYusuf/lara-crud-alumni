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
                    <b>STATUS PENDIDIKAN LANJUTAN (KULIAH)</b><br>
                    @if (isset($data->dikti))
                        <div class="d-flex justify-content-between">
                            <span class="badge bg-primary text-uppercase">Lanjut Kuliah</span>
                            <br>
                            <a href="{{ $data->dikti }}" target="_blank">Lihat PDDikti</a>
                        </div>
                    @else
                        <span class="badge bg-danger text-uppercase">Tidak Lanjut</span>
                    @endif
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
                    <b>KELAHIRAN</b><br>
                    <span>{{ $data->kelahiran }}</span>
                </li>
                <li class="list-group-item">
                    <b>AKUN IG (SOSIAL MEDIA)</b><br>
                    <span><a href="{{ $data->link }}" target="_blank">{{ $data->link }}</a></span>
                </li>
            </ul>
        </div>
    </div>
@endsection
