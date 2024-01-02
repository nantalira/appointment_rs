<script src="{{ asset('assets/js/today.js') }}"></script>
<?php
    $namaHariIni = isset($_POST['namaHariIni']) ? $_POST['namaHariIni'] : null;
?>
@include('layouts.head')
<body>

    <main>
      <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-5 col-md-7 d-flex flex-column align-items-center justify-content-center">

                <div class="d-flex justify-content-center py-4">
                  <a href="index.html" class="logo d-flex align-items-center w-auto">
                    <img src="assets/img/logo.png" alt="">
                    <span class="d-none d-lg-block">SamPooCong</span>
                  </a>
                </div><!-- End Logo -->

                <div class="card mb-3">

                  <div class="card-body">

                    <div class="pt-4 pb-2">
                      <h5 class="card-title text-center pb-0 fs-4">Daftar Poli</h5>
                      <p class="text-center small">Daftarkan diri anda untuk mendapatkan nomor antri</p>
                    </div>

                    <form  method="POST" action="{{route('pasien.pendaftaran_poli')}}"class="row g-3 needs-validation" novalidate>
                        @csrf
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                            </div>
                        @elseif (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="form-floating mb-1">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                @foreach ($jadwalUnik as $value)
                                    <p>
                                        @if ($value['antrianSaya'] == 0)
                                            Terdapat {{$value['antriSebelum']}} Antrian Pada {{$value['namaPoli']}} (Dr.{{ ucwords(strtolower($value['namaDokter'])) }}) <br>
                                        @else
                                            Anda Berada di Antrian ke-{{$value['antrianSaya']}} pada {{$value['namaPoli']}} (Dr.{{ ucwords(strtolower($value['namaDokter'])) }}) <br>
                                            Terdapat {{$value['antriSebelum']}} Pasien lagi sebelum anda
                                        @endif
                                    </p>
                                @endforeach
                            </div>
                        </div>

                        <input type="text" class="form-control" id="id" name="id" placeholder="id" value="{{$pasien->id}}" hidden required/>
                        <div class="col-12">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="nama" value="{{$pasien->nama}}" disabled required/>
                                <label for="nama">Nama Lengkap </label>
                                <div class="invalid-feedback">Masukkan nama anda</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating mb-1">
                                <select class="form-select" id="jadwal" name="id_jadwal" aria-label="Floating label select example" required>
                                    <option selected disabled>Pilih Jadwal</option>
                                    @foreach ($jadwal as $item)
                                        <option value="{{$item['id_jadwal']}}"> {{$item['nama_poli']}} - Dr.{{ ucwords(strtolower($item['nama'])) }} ({{ucwords(strtolower($item['hari']))}}, {{ucwords(strtolower($item['jam_mulai']))}}-{{ucwords(strtolower($item['jam_selesai']))}})</option>
                                    @endforeach
                                </select>
                                <label for="jadwal">Jadwal Poli</label>
                                <div class="invalid-feedback">Pilih poli dokter</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" id="keluhan" name="keluhan" placeholder="keluhan" required/>
                                <label for="keluhan">Keluhan</label>
                                <div class="invalid-feedback">Masukkan keluhan anda</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary w-100" type="submit">Daftar</button>
                        </div>
                        <div class="col-12">
                            <p class="small mb-0">Jika sudah selesai anda bisa Logout <a href="/logout">Disini</a></p>
                        </div>
                    </form>

                  </div>
                </div>

              </div>
            </div>
          </div>

        </section>

      </div>
    </main><!-- End #main -->

@include('layouts.foot')
