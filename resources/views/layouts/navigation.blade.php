<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-title">Modul Utama</li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-speedometer') }}"></use>
            </svg>
            {{ __('Dashboard') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('angkatan.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-calendar') }}"></use>
            </svg>
            {{ __('Angkatan') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('kelas.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-home') }}"></use>
            </svg>
            {{ __('Kelas') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('siswa.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-star') }}"></use>
            </svg>
            {{ __('Siswa') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
            </svg>
            {{ __('Users') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('about') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-info') }}"></use>
            </svg>
            {{ __('About us') }}
        </a>
    </li>

    <li class="nav-title">Filter By Angkatan</li>
    @php
        $getAngkatan = \App\Models\Angkatan::orderBy('id', 'ASC')->get();
    @endphp
    @foreach ($getAngkatan as $item)
        <li class="nav-group" aria-expanded="false">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-map') }}"></use>
                </svg>
                {{ $item->name }}
            </a>
            @php
                $getKelas = \App\Models\Kelas::where('angkatan_id', $item->id)
                    ->orderBy('id', 'ASC')
                    ->get();
            @endphp
            <ul class="nav-group-items" style="height: 0px;">
                @if (count($getKelas) > 0)
                    @foreach ($getKelas as $item2)
                        <li class="nav-item">
                            <a class="nav-link" href="#" target="_top">
                                <svg class="nav-icon">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>
                                </svg>
                                {{ $item2->name }}
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </li>
    @endforeach
</ul>
