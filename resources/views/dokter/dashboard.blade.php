@include('layouts.header')
@include('layouts.sidebar')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">
                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Hari <span>| Jadwal Saya</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>@if ($jadwalSaya == null)
                                            Belum Ada Jadwal
                                            @else
                                            {{ $jadwalSaya->hari }}
                                        @endif</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Jam Mulai <span>| WIB</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>@if ($jadwalSaya == null)
                                            Belum Ada Jadwal
                                            @else
                                            {{ $jadwalSaya->jam_mulai }}
                                        @endif</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Jam Selesai <span>| WIB</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>
                                            @if ($jadwalSaya == null)
                                                Belum Ada Jadwal
                                            @else
                                                {{ $jadwalSaya->jam_selesai }}
                                            @endif
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Customers Card -->
                </div>
            </div>
            <!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">
                <!-- Website Traffic -->
                <div class="card">
                    <div class="card-body pb-0">
                        <h5 class="card-title">Pasien Saya <span>| {{ $poli->nama_poli }}</span></h5>

                        <div id="trafficChart" style="min-height: 400px" class="echart"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const antri = {!! json_encode($jumlahAntrian) !!};
                                const riwayat = {!! json_encode($pasienTerperiksa) !!};
                                echarts.init(document.querySelector("#trafficChart")).setOption({
                                    tooltip: {
                                        trigger: "item",
                                    },
                                    legend: {
                                        top: "5%",
                                        left: "center",
                                    },
                                    series: [
                                        {
                                            name: "Access From",
                                            type: "pie",
                                            radius: ["40%", "70%"],
                                            avoidLabelOverlap: false,
                                            label: {
                                                show: false,
                                                position: "center",
                                            },
                                            emphasis: {
                                                label: {
                                                    show: true,
                                                    fontSize: "18",
                                                    fontWeight: "bold",
                                                },
                                            },
                                            labelLine: {
                                                show: false,
                                            },
                                            data: [
                                                {
                                                    value: antri,
                                                    name: "Belum Diperiksa",
                                                },
                                                {
                                                    value: riwayat,
                                                    name: "Sudah Diperiksa",
                                                },
                                            ],
                                        },
                                    ],
                                });
                            });
                        </script>
                    </div>
                </div>
                <!-- End Website Traffic -->
            </div>
            <!-- End Right side columns -->
        </div>
    </section>
</main>
<!-- End #main -->

@include('layouts.footer')
