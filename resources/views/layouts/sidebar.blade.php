<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link" href="index.html">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        @if ( session()->has('role') && session('role') == 'admin')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#"> <i class="bi bi-menu-button-wide"></i><span>Dokter</span><i class="bi bi-chevron-down ms-auto"></i> </a>
                <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{route('admin.manage_dokter')}}"> <i class="bi bi-circle"></i><span>Data Dokter</span> </a>
                    </li>
                    <li>
                        <a href="{{route('admin.create_dokter')}}"> <i class="bi bi-circle"></i><span>Tambah Dokter</span> </a>
                    </li>
                </ul>
            </li>
            <!-- End Components Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#"> <i class="bi bi-journal-text"></i><span>Poli</span><i class="bi bi-chevron-down ms-auto"></i> </a>
                <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="forms-elements.html"> <i class="bi bi-circle"></i><span>Data Poli</span> </a>
                    </li>
                    <li>
                        <a href="forms-layouts.html"> <i class="bi bi-circle"></i><span>Tambah Poli</span> </a>
                    </li>
                </ul>
            </li>
            <!-- End Forms Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#"> <i class="bi bi-layout-text-window-reverse"></i><span>Obat</span><i class="bi bi-chevron-down ms-auto"></i> </a>
                <ul id="tables-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="tables-general.html"> <i class="bi bi-circle"></i><span>Data Obat</span> </a>
                    </li>
                    <li>
                        <a href="tables-data.html"> <i class="bi bi-circle"></i><span>Tambah Obat</span> </a>
                    </li>
                </ul>
            </li>
            <!-- End Tables Nav -->
        <!-- End Sidebar-->
        @elseif (session()->has('role') && session('role') == 'dokter')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#"> <i class="bi bi-menu-button-wide"></i><span>Dokter</span><i class="bi bi-chevron-down ms-auto"></i> </a>
                <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="components-alerts.html"> <i class="bi bi-circle"></i><span>Data Dokter</span> </a>
                    </li>
                    <li>
                        <a href="components-accordion.html"> <i class="bi bi-circle"></i><span>Tambah Dokter</span> </a>
                    </li>
                </ul>
            </li>
            <!-- End Components Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#"> <i class="bi bi-journal-text"></i><span>Poli</span><i class="bi bi-chevron-down ms-auto"></i> </a>
                <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="forms-elements.html"> <i class="bi bi-circle"></i><span>Data Poli</span> </a>
                    </li>
                    <li>
                        <a href="forms-layouts.html"> <i class="bi bi-circle"></i><span>Tambah Poli</span> </a>
                    </li>
                </ul>
            </li>
            <!-- End Forms Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#"> <i class="bi bi-layout-text-window-reverse"></i><span>Obat</span><i class="bi bi-chevron-down ms-auto"></i> </a>
                <ul id="tables-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="tables-general.html"> <i class="bi bi-circle"></i><span>Data Obat</span> </a>
                    </li>
                    <li>
                        <a href="tables-data.html"> <i class="bi bi-circle"></i><span>Tambah Obat</span> </a>
                    </li>
                </ul>
        </li>
        @endif
    </ul>
</aside>

