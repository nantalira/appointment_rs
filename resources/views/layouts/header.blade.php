@include('layouts.head')
<!-- ======= Header ======= -->
<body>

    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="
            @if (session()->has('role') && session('role') == 'admin')
                {{ route('admin.dashboard') }}
            @elseif (session()->has('role') && session('role') == 'pasien')
                {{ route('pasien.dashboard') }}
            @elseif (session()->has('role') && session('role') == 'dokter')
                {{ route('dokter.dashboard') }}
            @endif
            " class="logo d-flex align-items-center">
                <img src="{{ asset('assets/img/logo.png') }}" alt="" />
                <span class="d-none d-lg-block">NiceAdmin</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <span class="d-none d-md-block dropdown-toggle ps-2">
                            @if (session()->has('role') && session('role') == 'admin')
                                Admin
                            @elseif (session()->has('role') && session('role') == 'pasien')
                                {{ucwords(strtolower($pasien['nama']))}}
                            @elseif (session()->has('role') && session('role') == 'dokter')
                                {{ucwords(strtolower($dokter['nama']))}}
                            @endif
                        </span>
                        <span class="d-block d-md-none">
                            @if (session()->has('role') && session('role') == 'admin')
                                Admin
                            @elseif (session()->has('role') && session('role') == 'pasien')
                                {{ucwords(strtolower($pasien['nama']))}}
                            @elseif (session()->has('role') && session('role') == 'dokter')
                                {{ucwords(strtolower($dokter['nama']))}}
                            @endif
                        </span>
                    </a>
                    <!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>
                                @if (session()->has('role') && session('role') == 'admin')
                                Admin
                                @elseif (session()->has('role') && session('role') == 'pasien')
                                    {{ucwords(strtolower($pasien['nama']))}}
                                @elseif (session()->has('role') && session('role') == 'dokter')
                                    {{ucwords(strtolower($dokter['nama']))}}
                                @endif
                            </h6>
                            <span>{{ ucwords(strtolower($session['role'])) }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>

                        <li>
                            @if (session()->has('role') && session('role') == 'dokter')
                                <a class="dropdown-item d-flex align-items-center" href="{{route('admin.edit_dokter.form', $dokter->id)}}">
                                    <i class="bi bi-person"></i>
                                    <span>Profil Saya</span>
                                </a>
                            @endif
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{route('logout')}}">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Log Out</span>
                            </a>
                        </li>
                    </ul>
                    <!-- End Profile Dropdown Items -->
                </li>
                <!-- End Profile Nav -->
            </ul>
        </nav>
        <!-- End Icons Navigation -->
    </header>
    <!-- End Header -->
