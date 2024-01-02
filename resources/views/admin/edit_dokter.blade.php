@include('layouts.header')
@include('layouts.sidebar')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Data Dokter</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item active">Edit Dokter</li>
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
                        <form method="POST" action="{{route('admin.edit_dokter', ['id' => $dokter->id])}}" class="needs-validation">
                            @csrf
                            @method('PUT')
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                </div>
                            @elseif (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="row mb-1">
                                <div class="col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="nama" value="{{$dokter->nama}}" required/>
                                        <label for="nama">Nama Lengkap</label>
                                        <div class="invalid-feedback">Masukkan nama dokter </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="email" placeholder="email" name="email"value="{{$dokter->email}}" required/>
                                        <label for="email">Email</label>
                                        <div class="invalid-feedback">Masukkan email yang valid</div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="no_hp" value="{{$dokter->no_hp}}" required/>
                                        <label for="no_hp">Nomor HP</label>
                                        <div class="invalid-feedback">Masukkan nomor hp dokter</div>
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
                                        <textarea class="form-control" placeholder="alamat" id="alamat" name="alamat" style="height: 100px" required>{{ $dokter->alamat }}</textarea>
                                        <label for="alamat">Alamat</label>
                                        <div class="invalid-feedback">Masukkan alamat dokter</div>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="poli" name="id_poli" aria-label="Floating label select example" required>
                                            <option selected disabled>Pilih Poli</option>
                                            @foreach ($poli as $item)
                                                <option value="{{$item['id']}}" @if ($item['id'] == $dokter->id_poli) selected @endif>{{ucwords(strtolower($item['nama_poli']))}}</option>
                                            @endforeach
                                        </select>
                                        <label for="poli">Poli</label>
                                        <div class="invalid-feedback">Pilih poli dokter</div>
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
