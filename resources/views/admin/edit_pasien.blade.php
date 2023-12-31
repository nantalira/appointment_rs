@include('layouts.header')
@include('layouts.sidebar')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Data Pasien</h1>
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
                        <h5 class="card-title">Edit Data</h5>

                        <!-- Advanced Form Elements -->
                        <form method="POST" action="{{route('admin.edit_pasien', ['id' => $pasien->id])}}" class="needs-validation">
                            @csrf
                            @method('PUT')
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="row mb-1">
                                <div class="col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="nama" value="{{$pasien->nama}}" required/>
                                        <label for="nama">Nama Lengkap</label>
                                        <div class="invalid-feedback">Masukkan nama pasien</div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="email" placeholder="email" name="email"value="{{$pasien->email}}" required/>
                                        <label for="email">Email</label>
                                        <div class="invalid-feedback">Masukkan email yang valid</div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="no_hp" value="{{$pasien->no_hp}}" required/>
                                        <label for="no_hp">Nomor HP</label>
                                        <div class="invalid-feedback">Masukkan nomor hp pasien</div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="no_ktp" name="no_ktp" placeholder="no_ktp" value="{{$pasien->no_ktp}}" required/>
                                        <label for="no_ktp">Nomor KTP</label>
                                        <div class="invalid-feedback">Masukkan nomor ktp pasien</div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="no_rm" name="no_rm" placeholder="no_rm" value="{{$pasien->no_rm}}" required/>
                                        <label for="no_rm">Nomor RM</label>
                                        <div class="invalid-feedback">Masukkan nomor rm pasien</div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="password-lama" name="password-lama"/>
                                        <label for="password-lama">Password Lama</label>
                                        <div class="invalid-feedback">Masukkan password lama</div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="password-baru" name="password-baru"/>
                                        <label for="password-baru">Password Baru</label>
                                        <div class="invalid-feedback">Masukkan password baru</div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" placeholder="alamat" id="alamat" name="alamat" style="height: 100px" required>{{ $pasien->alamat }}</textarea>
                                        <label for="alamat">Alamat</label>
                                        <div class="invalid-feedback">Masukkan alamat pasien</div>
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
