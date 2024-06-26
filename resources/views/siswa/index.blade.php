@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            List Alumni
        </div>

        <div class="alert alert-info" role="alert">Menampilkan data alumni</div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">{{ $message }}</div>
        @endif
        <div class="d-flex justify-content-end px-4">
            <a href="{{ route('siswa.create') }}" class="btn btn-primary">Add Data</a>
        </div>

        <div class="card-body">

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Name</th>
                        <th scope="col">Angkatan</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Kelahiran</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswas as $siswa)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ Storage::url('siswa_foto/' . $siswa->foto) }}" width="150px" alt="">
                            </td>
                            <td>{{ $siswa->name }}</td>
                            <td>{{ $siswa->angkatan->name }}</td>
                            <td>{{ $siswa->kelas->name }}</td>
                            <td>{{ $siswa->kelahiran }}</td>
                            <td>
                                @if (isset($siswa->dikti))
                                    <span class="badge bg-primary text-uppercase">Lanjut Kuliah</span>
                                @else
                                    <span class="badge bg-danger text-uppercase">Tidak Lanjut</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex">
                                    <div class="btn-group">
                                        @if (isset($siswa->dikti))
                                            <a href="{{ $siswa->dikti }}" target="_blank"
                                                class="btn btn-primary">PDDikti</a>
                                        @endif
                                        <a href="{{ $siswa->link }}" target="_blank" class="btn btn-secondary">IG</a>
                                        <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Yakin ingin menghapus data?')" type="submit"
                                                class="btn btn-danger" style="border-radius: 0px !important;">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        new DataTable('.table');
    </script>
@endpush
