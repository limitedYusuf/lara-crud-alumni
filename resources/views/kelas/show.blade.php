@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            List Siswa {{ $kela->name }}
        </div>

        <div class="alert alert-info" role="alert">Menampilkan data siswa di kelas {{ $kela->name }}</div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">{{ $message }}</div>
        @endif

        <div class="card-body">

            <div class="d-flex justify-content-center mb-3">
                <div id="chart"></div>
            </div>

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.44.0/apexcharts.min.js"
        integrity="sha512-9ktqS1nS/L6/PPv4S4FdD2+guYGmKF+5DzxRKYkS/fV5gR0tXoDaLqqQ6V93NlTj6ITsanjwVWZ3xe6YkObIQQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        new DataTable('.table');

        let rekap = @json($rekap);

        var options = {
            chart: {
                width: 400,
                type: 'pie',
            },
            series: Object.values(rekap),
            labels: Object.keys(rekap),
            colors: ['#66a3ff', '#ff6666'],
            legend: {
                position: 'bottom',
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
@endpush
