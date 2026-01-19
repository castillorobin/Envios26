@extends('layouts.auth_app')
@section('title')
    Admin Login
@endsection
@section('content')
    

        <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="card auth-card">
                            <div class="card-body p-0">
                                <div class="row align-items-center g-0">
                                    <div class="col-lg-6 d-none d-lg-inline-block border-end">
                                        <div class="auth-page-sidebar">
                                            <img src="assets/images/sign-in.svg" alt="auth" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="p-4">
                                            <div class="mx-auto mb-4 text-center auth-logo">
                                                <a href="index.html" class="logo-dark">
                                                     <img src="{{ asset('img/logomelonegro.png') }}" alt="logo" width="200"
                             class="shadow-light">
                                                </a>

                                                
                                            </div>
                                            <h2 class="fw-bold text-center fs-18">
                                                Sign In
                                            </h2>
                                            <p class="text-muted text-center mt-1 mb-4">
                                                Ingrese su correo y contraseña para acceder al sistema
                                            </p>

                                            <div class="row justify-content-center">
                                                <div class="col-12 col-md-8">
                                                    <form method="POST" action="{{ route('login') }}">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger p-0">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                                                        <div class="mb-3">
                                                            <label class="form-label" for="example-email">Email</label>
                                                            <input type="email" id="example-email" name="example-email" class="form-control" placeholder="Enter your email">
                                                        </div>
                                                        <div class="mb-3">
                                                          
                                                            <label class="form-label" for="example-password">Contraseña</label>
                                                            <input type="password" id="example-password" class="form-control" placeholder="Enter your password">
                                                        </div>
                                                        <div class="mb-3">
                                                           
                                                        </div>

                                                        <div class="mb-1 text-center d-grid">
                                                            <button class="btn btn-primary" type="submit">
                                                                Entrar
                                                            </button>
                                                        </div>
                                                    </form>

                                                   
                                                </div>
                                                <!-- end col -->
                                            </div>
                                            <!-- end row -->
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->
                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
        </div>

        <!-- Vendor Javascript (Require in all Page) -->
        <script src="assets/js/vendor.js"></script>

        <!-- App Javascript (Require in all Page) -->
        <script src="assets/js/app.js"></script>

    

<svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;"><defs id="SvgjsDefs1002"></defs><polyline id="SvgjsPolyline1003" points="0,0"></polyline><path id="SvgjsPath1004" d="M0 0 "></path></svg>

@endsection
