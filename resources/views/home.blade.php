@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Dashboard') }}
        </div>
        <div class="card-body">
            {{ __('You are logged in!') }}
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="card mb-4">
                <div class="card-header">
                    Cari Alumni Berdasarkan Nama
                </div>
                <div class="card-body">
                    <form action="{{ route('siswa.search') }}" method="post">
                        @csrf
                        <select name="id" id="select" class="form-select w-100" required>
                            <option value="">-- Cari Data --</option>
                            @foreach ($siswa as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <div class="d-flex justify-content-center mt-2">
                            <button type="submit" class="btn btn-primary fw-bold">Cari...</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h5 style="margin-bottom: 0px !important;"><b>TOTAL ALUMNI KESELURUHAN :
                            {{ number_format($countSiswa, 0, '.', '.') }}</b></h5>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <div id="chart"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.44.0/apexcharts.min.js"
        integrity="sha512-9ktqS1nS/L6/PPv4S4FdD2+guYGmKF+5DzxRKYkS/fV5gR0tXoDaLqqQ6V93NlTj6ITsanjwVWZ3xe6YkObIQQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            $('#select').select2({
                theme: 'bootstrap-5'
            });

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

        });
    </script>
@endpush
