@include('layouts.header')
@include('layouts.sidebar')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Tambah Obat</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item active">Tambah Obat</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-5">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Masukkan Data Obat</h5>

                        <!-- Advanced Form Elements -->
                        <form method="POST" action="{{ route('admin.create_obat') }}" class="needs-validation">
                            @csrf
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="row mb-1">
                                <div class="col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="nama_obat" name="nama_obat" placeholder="nama_obat" required/>
                                        <label for="nama_obat">Nama Obat</label>
                                        <div class="invalid-feedback">Masukkan nama obat</div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="kemasan" name="kemasan" placeholder="kemasan" required/>
                                        <label for="kemasan">Kemasan</label>
                                        <div class="invalid-feedback">Masukkan kemasan obat</div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="harga" name="harga" placeholder="harga" required/>
                                        <label for="harga">Harga</label>
                                        <div class="invalid-feedback">Masukkan harga obat</div>
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
