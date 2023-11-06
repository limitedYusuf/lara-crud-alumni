@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            List Angkatan
        </div>

        <div class="alert alert-info" role="alert">Menampilkan data angkatan</div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">{{ $message }}</div>
        @endif
        <div class="d-flex justify-content-end px-4">
            <a href="{{ route('angkatan.create') }}" class="btn btn-primary">Add Data</a>
        </div>

        <div class="card-body">

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($angkatans as $angkatan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $angkatan->name }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('angkatan.edit', $angkatan->id) }}" class="btn btn-warning"
                                        style="margin-right: 10px;">Edit</a>
                                    <form action="{{ route('angkatan.destroy', $angkatan->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Yakin ingin menghapus data?')" type="submit"
                                            class="btn btn-danger">Hapus</button>
                                    </form>
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
