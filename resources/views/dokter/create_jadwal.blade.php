@include('layouts.header')
@include('layouts.sidebar')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Tambah Jadwal</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active">Elements</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-5">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Masukkan Jadwal Anda</h5>

                        <!-- Advanced Form Elements -->
                        <form method="POST" action="{{ route('dokter.create_jadwal') }}" class="needs-validation">
                            @csrf
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="row mb-1">
                                <div class="col-sm-12">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="hari" name="hari" aria-label="Floating label select example" required>
                                            <option selected disabled>Pilih Hari</option>
                                            <option value="Senin">Senin</option>
                                            <option value="Selasa">Selasa</option>
                                            <option value="Rabu">Rabu</option>
                                            <option value="Kamis">Kamis</option>
                                            <option value="Jumat">Jumat</option>
                                            <option value="Sabtu">Sabtu</option>
                                        </select>
                                        <label for="hari">Hari</label>
                                        <div class="invalid-feedback">Pilih hari</div>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" placeholder="jam_mulai" required/>
                                        <label for="jam_mulai">Jam Mulai</label>
                                        <div class="invalid-feedback">Masukkan jam mulai</div>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" placeholder="jam_selesai" required/>
                                        <label for="jam_selesai">Jam Selesai</label>
                                        <div class="invalid-feedback">Masukkan jam selesai</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                            </div>
                        </form>
                        <!-- End General Form Elements -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- End #main -->
@include('layouts.footer')
