@extends('layouts.guest')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.44.0/apexcharts.min.js"
        integrity="sha512-9ktqS1nS/L6/PPv4S4FdD2+guYGmKF+5DzxRKYkS/fV5gR0tXoDaLqqQ6V93NlTj6ITsanjwVWZ3xe6YkObIQQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    {{ __('Dashboard') }}
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-warning">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="d-flex justify-content-between">
                        <div class="left">
                            Selamat Datang <b>{{ auth()->user()->name }}</b>
                        </div>
                        <div class="right">
                            <form action="{{ route('alumni.logout') }}" method="post">
                                @csrf
                                <button type="submit" onclick="return confirm('Yakin ingin logout?')"
                                    class="btn btn-danger btn-sm">Keluar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card mb-4">
                <div class="card-header">
                    Cari Alumni Berdasarkan Nama
                </div>
                <div class="card-body">
                    <form action="{{ route('alumni.dashboard') }}" method="get">
                        <select name="code" id="select" class="form-select w-100" required>
                            <option value="">-- Cari Data --</option>
                            @foreach ($siswa as $item)
                                <option value="{{ $item->id }}" {{ request()->code == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                        <div class="d-flex justify-content-center mt-2">
                            <button type="submit" class="btn btn-primary fw-bold">Cari...</button>
                        </div>
                    </form>
                </div>
            </div>

            @if (!empty(request()->code))
                @php
                    $detail = \App\Models\Siswa::where('id', request()->code)->first();
                @endphp
                <div class="card mb-4">
                    <div class="card-body">
                        @if ($detail)
                            <h5 class="text-center"><b>DETAIL ALUMNI</b></h5>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <b>FOTO</b><br>
                                    <img src="{{ Storage::url('siswa_foto/' . $detail->foto) }}" width="200px"
                                        alt="">
                                </li>
                                <li class="list-group-item">
                                    <b>STATUS PENDIDIKAN LANJUTAN (KULIAH)</b><br>
                                    @if (isset($detail->dikti))
                                        <div class="d-flex justify-content-between">
                                            <span class="badge bg-primary text-uppercase">Lanjut Kuliah</span>
                                            <br>
                                            <a href="{{ $detail->dikti }}" target="_blank">Lihat PDDikti</a>
                                        </div>
                                    @else
                                        <span class="badge bg-danger text-uppercase">Tidak Lanjut</span>
                                    @endif
                                </li>
                                <li class="list-group-item">
                                    <b>NAMA</b><br>
                                    <span>{{ $detail->name }}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>ANGKATAN</b><br>
                                    <span>{{ $detail->angkatan->name }}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>KELAS</b><br>
                                    <span>{{ $detail->kelas->name }}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Akun IG (Sosmed)</b><br>
                                    <span><a href="{{ $detail->link }}" target="_blank">{{ $detail->link }}</a></span>
                                </li>
                            </ul>
                        @else
                            <h5 class="text-center text-danger" style="margin-bottom: 0px !important;"><b>TIDAK ADA
                                    DATA...</b></h5>
                        @endif
                    </div>
                </div>
            @endif

            <div class="card mb-4">
                <div class="card-body">
                    <h5 style="margin-bottom: 0px !important;"><b>TOTAL ALUMNI KESELURUHAN :
                            {{ number_format($countSiswa, 0, '.', '.') }}</b></h5>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="text-center"><b>AJUKAN UBAH / HAPUS / TAMBAH INFO ALUMNI</b></h6>
                    <form action="{{ route('alumni.postComment') }}" method="post">
                        @csrf
                        <textarea name="comment" class="w-100 form-control" placeholder="Ketik disini..." required id=""
                            rows="4"></textarea>
                        <div class="d-flex justify-content-end mt-2">
                            <button type="submit" class="btn btn-success fw-bold">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="chart"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h4><b>REKAP INFO ALUMNI SETELAH LULUS</b></h4>
                            <div id="chart2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills nav-justified">
                        @foreach ($angkatans as $key => $item)
                            <li class="nav-item">
                                <a class="nav-link {{ $key == 0 ? 'active' : '' }}" id="{{ Str::slug($item->id) }}"
                                    data-bs-toggle="pill"
                                    href="#content{{ $item->id }}"><b>{{ $item->name }}</b></a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content mt-2">
                        @foreach ($angkatans as $key => $item)
                            <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}"
                                id="content{{ $item->id }}">
                                <div class="accordion mt-4" id="accordionExample">
                                    @php
                                        $kelasData = \App\Models\Kelas::where('angkatan_id', $item->id)
                                            ->orderBy('id', 'ASC')
                                            ->get();
                                    @endphp

                                    <div class="d-flex justify-content-center mb-2">
                                        <div id="chartAngkatan{{ $key }}"></div>
                                    </div>

                                    @php
                                        $rekapAngkatan = [
                                            'Lanjut Kuliah' => \App\Models\Siswa::where('angkatan_id', $item->id)
                                                ->where('dikti', '!=', null)
                                                ->count(),
                                            'Tidak Melanjutkan Pendidikan' => \App\Models\Siswa::where(
                                                'angkatan_id',
                                                $item->id,
                                            )
                                                ->whereNull('dikti')
                                                ->count(),
                                        ];
                                    @endphp

                                    <script>
                                        var optionsAngkatan = {
                                            chart: {
                                                width: 400,
                                                type: 'pie',
                                            },
                                            series: Object.values(@json($rekapAngkatan)),
                                            labels: Object.keys(@json($rekapAngkatan)),
                                            colors: ['#66a3ff', '#ff6666'],
                                            legend: {
                                                position: 'bottom',
                                            },
                                        };

                                        var chartAngkatan = new ApexCharts(document.querySelector("#chartAngkatan{{ $key }}"), optionsAngkatan);

                                        chartAngkatan.render();
                                    </script>

                                    @forelse ($kelasData as $keyKelas => $itemKelas)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header"
                                                id="heading{{ $key }}{{ $keyKelas }}">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{ $key }}{{ $keyKelas }}"
                                                    aria-expanded="false"
                                                    aria-controls="collapse{{ $key }}{{ $keyKelas }}">
                                                    {{ $itemKelas->name }}
                                                </button>
                                            </h2>
                                            <div id="collapse{{ $key }}{{ $keyKelas }}"
                                                class="accordion-collapse collapse"
                                                aria-labelledby="heading{{ $key }}{{ $keyKelas }}"
                                                data-bs-parent="#accordionExample">
                                                @php
                                                    $listAlumni = \App\Models\Siswa::with(['angkatan', 'kelas'])
                                                        ->where('kelas_id', $itemKelas->id)
                                                        ->orderBy('name', 'ASC')
                                                        ->get();
                                                @endphp

                                                <div class="accordion-body">
                                                    <div class="d-flex justify-content-center mb-2">
                                                        <div id="chartKelas{{ $key }}{{ $keyKelas }}"></div>
                                                    </div>

                                                    @php
                                                        $rekapKelas = [
                                                            'Lanjut Kuliah' => \App\Models\Siswa::where(
                                                                'angkatan_id',
                                                                $item->id,
                                                            )
                                                                ->where('kelas_id', $itemKelas->id)
                                                                ->where('dikti', '!=', null)
                                                                ->count(),
                                                            'Tidak Melanjutkan Pendidikan' => \App\Models\Siswa::where(
                                                                'angkatan_id',
                                                                $item->id,
                                                            )
                                                                ->where('kelas_id', $itemKelas->id)
                                                                ->whereNull('dikti')
                                                                ->count(),
                                                        ];
                                                    @endphp

                                                    <script>
                                                        var optionsKelas = {
                                                            chart: {
                                                                width: 350,
                                                                type: 'pie',
                                                            },
                                                            series: Object.values(@json($rekapKelas)),
                                                            labels: Object.keys(@json($rekapKelas)),
                                                            colors: ['#66a3ff', '#ff6666'],
                                                            legend: {
                                                                position: 'bottom',
                                                            },
                                                        };

                                                        var chartKelas = new ApexCharts(document.querySelector("#chartKelas{{ $key }}{{ $keyKelas }}"),
                                                            optionsKelas);

                                                        chartKelas.render();
                                                    </script>

                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">ID</th>
                                                                    <th scope="col">Foto</th>
                                                                    <th scope="col">Name</th>
                                                                    <th scope="col">Angkatan</th>
                                                                    <th scope="col">Kelas</th>
                                                                    <th scope="col">Status</th>
                                                                    <th scope="col">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($listAlumni as $siswaData)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td><img src="{{ Storage::url('siswa_foto/' . $siswaData->foto) }}"
                                                                                width="150px" alt="">
                                                                        </td>
                                                                        <td>{{ $siswaData->name }}</td>
                                                                        <td>{{ $siswaData->angkatan->name }}</td>
                                                                        <td>{{ $siswaData->kelas->name }}</td>

                                                                        <td>
                                                                            @if (isset($siswaData->dikti))
                                                                                <span
                                                                                    class="badge bg-primary text-uppercase">Lanjut
                                                                                    Kuliah</span>
                                                                            @else
                                                                                <span
                                                                                    class="badge bg-danger text-uppercase">Tidak
                                                                                    Lanjut</span>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            <div class="d-flex">
                                                                                @if (isset($siswaData->dikti))
                                                                                    <a href="{{ $siswaData->dikti }}"
                                                                                        target="_blank"
                                                                                        class="btn btn-primary"
                                                                                        style="margin-left: 10px;">PDDikti</a>
                                                                                @endif
                                                                                <a href="{{ $siswaData->link }}"
                                                                                    target="_blank"
                                                                                    class="btn btn-secondary"
                                                                                    style="margin-left: 10px;">Akun IG</a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <h5 class="text-center text-danger mt-4" style="margin-bottom: 0px !important;">
                                            <b>TIDAK ADA
                                                DATA...</b>
                                        </h5>
                                    @endforelse
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#select').select2({
                theme: 'bootstrap-5'
            });

            new DataTable('.table');

            var data = @json($data);

            if (data && data.length > 0) {
                var categories = data.map(function(item) {
                    return item.name;
                });

                var seriesData = data.map(function(item) {
                    return item.count;
                });

                var options = {
                    series: [{
                        name: 'Jumlah Siswa',
                        data: seriesData,
                    }],
                    chart: {
                        type: 'bar',
                        height: 350,
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '55%',
                            endingShape: 'rounded',
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent'],
                    },
                    xaxis: {
                        categories: categories,
                    },
                    yaxis: {
                        title: {
                            text: 'Jumlah Alumni',
                        },
                    },
                    fill: {
                        opacity: 1,
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return val;
                            },
                        },
                    },
                };

                var chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();
            } else {
                console.error('Data is empty or undefined.');
            }

            let rekap = @json($rekap);

            var options2 = {
                chart: {
                    type: 'pie',
                },
                series: Object.values(rekap),
                labels: Object.keys(rekap),
                colors: ['#66a3ff', '#ff6666'],
                legend: {
                    position: 'bottom',
                },
            };

            var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
            chart2.render();

        });
    </script>
@endpush
