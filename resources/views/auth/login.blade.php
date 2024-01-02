@include('layouts.head')

<body>

    <main>
      <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="d-flex justify-content-center py-4">
                  <a href="index.html" class="logo d-flex align-items-center w-auto">
                    <img src="assets/img/logo.png" alt="">
                    <span class="d-none d-lg-block">SamPooCong</span>
                  </a>
                </div><!-- End Logo -->

                <div class="card mb-3">

                  <div class="card-body">

                    <div class="pt-4 pb-2">
                      <h5 class="card-title text-center pb-0 fs-4">Masuk</h5>
                      <p class="text-center small">Selamat Datang di Sistem Temu Janji Dokter</p>
                    </div>

                    <form  method="POST" action="{{ route('login') }}" class="row g-3 needs-validation" novalidate>
                        @csrf
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="col-12">
                            <div class="form-floating mb-1">
                                <input type="email" class="form-control" id="email" placeholder="email" name="email" required/>
                                <label for="email">Email</label>
                                <div class="invalid-feedback">Masukkan email yang valid</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating mb-1">
                                <input type="password" class="form-control" id="password" placeholder="Password" name="password" required/>
                                <label for="password">Password</label>
                                <div class="invalid-feedback">Masukkan password</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100" type="submit">Login</button>
                        </div>
                      <div class="col-12">
                        <p class="small mb-0">Belum punya akun? <a href="/register">Buat akun anda</a></p>
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
