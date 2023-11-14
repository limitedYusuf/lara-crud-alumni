@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Akun Alumni') }}
        </div>

        <div class="alert alert-info" role="alert">Menampilkan akun alumni yang terdaftar</div>

        <div class="card-body">

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">
                            <center>Status</center>
                        </th>
                        <th scope="col">
                            <center>Aksi</center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alumnis as $alumni)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $alumni->name }}</td>
                            <td>{{ $alumni->email }}</td>
                            <td>
                                <center>
                                    @if ($alumni->status == 'Y')
                                        <span class="badge text-bg-primary">AKTIF</span>
                                    @else
                                        <span class="badge text-bg-danger">NONAKTIF</span>
                                    @endif
                                </center>
                            </td>
                            <td>
                                @if ($alumni->status == 'Y')
                                    <div class="d-flex justify-content-center">
                                        <form action="{{ route('akun.destroy', $alumni->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Yakin ingin menghapus data?')" type="submit"
                                                class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                @else
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('akun.edit', $alumni->id) }}" class="btn btn-secondary btn-sm"
                                            style="margin-right: 10px;">Terima</a>
                                        <form action="{{ route('akun.destroy', $alumni->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Yakin ingin menghapus data?')" type="submit"
                                                class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                @endif
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
