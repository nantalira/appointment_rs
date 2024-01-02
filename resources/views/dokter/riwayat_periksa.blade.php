@include('layouts.header')
@include('layouts.sidebar')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Riwayat Pasien</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Riwayat Pasien</h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Pasien</th>
                                    <th scope="col">Keluhan</th>
                                    <th scope="col">Tanggal Periksa</th>
                                    <th scope="col">Obat</th>
                                    <th scope="col">Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($periksa as $riwayat)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $riwayat['nama'] }}</td>
                                        <td>{{ $riwayat['keluhan'] }}</td>
                                        <td>{{ $riwayat['tgl_periksa'] }}</td>
                                        <td>
                                            @foreach ($riwayat['obat'] as $obat)
                                                {{ $obat['nama_obat'] }}<br>
                                            @endforeach
                                        </td>
                                        <td>{{ $riwayat['catatan'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif
</main>

<!-- End #main -->
@include('layouts.footer')
