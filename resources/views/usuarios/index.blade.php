@extends('layouts.app')

@section('content')
<div class="container-xxl">
                    <!-- ========== Page Title Start ========== -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="mb-0 fw-semibold">Listado de usuarios</h4>
                                
                            </div>
                        </div>
                    </div>
                    <!-- ========== Page Title End ========== -->


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                                        <div>
                                            <form class="d-flex flex-wrap align-items-center gap-2">
                                                <label for="inputPassword2" class="visually-hidden">Buscar usuario</label>
                                                <div class="search-bar me-3">
                                                    <span><i class="bx bx-search-alt"></i></span>
                                                    <input type="search" class="form-control" id="search" placeholder="Buscar usuario ...">
                                                </div>

                                                
                                            </form>
                                        </div>
                                        <div>
                                            <div class="d-flex flex-wrap gap-2 justify-content-md-end align-items-center">
                                               

                                                <a href="{{ route('usuarios.create') }}" class="btn btn-danger">
                                                    <i class="bi bi-plus-circle me-1"></i>Agregar usuario
                                                </a>
                                            </div>
                                        </div>
                                        <!-- end col-->
                                    </div>
                                    <!-- end row -->
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col-->
                    </div>

                    <div class="tab-content pt-0">
                        <div class="tab-pane show active" id="team-list" role="tabpanel">
                            <div class="card overflow-hidden">
                                <div class="table-responsive table-centered">
                                    <table class="table text-nowrap mb-0">
                                        <thead class="teble-light">
                                            <tr>
                                                <th>Usuario</th>
                                                
                                                <th>Fecha de incorporación</th>
                                                <th>Email</th>
                                                <th>Rol</th>
                                                <th>Último acceso</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <!-- end thead-->
                                        <tbody>

                                            @foreach ($usuarios as $usuario)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-1">
                                                        
                                                        {{ $usuario->name }}</a>
                                                    </div>
                                                </td>
                                                
                                                <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                                                <td>{{ $usuario->email }}</td>
                                                <td>
                                                   
                                                        <h5><span class="badge badge-dark">{{ $usuario->getRoleNames()->first() ?? 'Sin Rol' }}</span></h5>
                                               
                                                    
                                                </td>
                                                <td>
                                                    @if($usuario->last_login_at)
                                                        <div class="d-flex flex-column">
                                                            <span class="fw-bold text-gray-800">
                                                                {{ \Carbon\Carbon::parse($usuario->last_login_at)->format('d/m/Y') }}
                                                            </span>
                                                            <span class="text-muted small">
                                                                {{ \Carbon\Carbon::parse($usuario->last_login_at)->format('h:i A') }} 
                                                                ({{ \Carbon\Carbon::parse($usuario->last_login_at)->diffForHumans() }})
                                                            </span>
                                                        </div>
                                                    @else
                                                        <span class="badge badge-light-secondary text-muted">Nunca ha ingresado</span>
                                                    @endif
                                                </td>
                                                <td></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-soft-secondary me-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path fill="currentColor" fill-rule="evenodd" d="M12 5C7.336 5 3.6 7.903 2 12c1.6 4.097 5.336 7 10 7s8.4-2.903 10-7c-1.6-4.097-5.336-7-10-7m0 10a3 3 0 1 0 0-6a3 3 0 0 0 0 6" clip-rule="evenodd" opacity="0.16"/><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 1 1-6 0a3 3 0 0 1 6 0"/><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 12c1.6-4.097 5.336-7 10-7s8.4 2.903 10 7c-1.6 4.097-5.336 7-10 7s-8.4-2.903-10-7"/></g></svg>
                                                    </button>
                                                    
                                                </td>
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                        <!-- end tbody -->
                                    </table>
                                    <!-- end table -->
                                </div>
                                <!-- table responsive -->
                                <div class="align-items-center justify-content-between row g-0 text-center text-sm-start p-3 border-top">
                                    
                                </div>
                            </div>
                            <!-- end card -->
                        </div>

                        <div class="tab-pane" id="team-grid" role="tabpanel">
                            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5 gx-3">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <img src="assets/images/users/avatar-1.jpg" alt="avatar-1" class="img-fluid avatar-xxl img-thumbnail rounded-circle avatar-border">
                                                <h4 class="mt-3">
                                                    <a href="javascript:void(0);">Anna M. Hines</a>
                                                </h4>
                                                <a href="javascript:void(0);" class="mb-1 d-inline-block"><i class="bx bx-location-plus text-danger fs-14 me-1"></i>Burr Ridge/Illinois</a>
                                                <br>
                                                <a href="javascript:void(0);"><i class="bx bx-phone-call text-success fs-14 me-1"></i>555-1564-261</a>
                                                <br>
                                                <a href="#!" class="btn btn-sm btn-outline-primary mt-2">View All Details</a>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <img src="assets/images/users/avatar-2.jpg" alt="avatar-2" class="img-fluid avatar-xxl img-thumbnail rounded-circle avatar-border">
                                                <h4 class="mt-3">
                                                    <a href="javascript:void(0);">Candice F. Gilmore</a>
                                                </h4>
                                                <a href="javascript:void(0);" class="mb-1 d-inline-block"><i class="bx bx-location-plus text-danger fs-14 me-1"></i>Roselle/Illinois</a>
                                                <br>
                                                <a href="javascript:void(0);"><i class="bx bx-phone-call text-success fs-14 me-1"></i>755-5532-588</a>
                                                <br>
                                                <a href="#!" class="btn btn-sm btn-outline-primary mt-2">View All Details</a>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <img src="assets/images/users/avatar-3.jpg" alt="avatar-3" class="img-fluid avatar-xxl img-thumbnail rounded-circle avatar-border">
                                                <h4 class="mt-3">
                                                    <a href="javascript:void(0);">Vanessa R. Davis</a>
                                                </h4>
                                                <a href="javascript:void(0);" class="mb-1 d-inline-block"><i class="bx bx-location-plus text-danger fs-14 me-1"></i>Wann/Oklahoma</a>
                                                <br>
                                                <a href="javascript:void(0);"><i class="bx bx-phone-call text-success fs-14 me-1"></i>441-5558-183</a>
                                                <br>
                                                <a href="#!" class="btn btn-sm btn-outline-primary mt-2">View All Details</a>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <img src="assets/images/users/avatar-4.jpg" alt="avatar-4" class="img-fluid avatar-xxl img-thumbnail rounded-circle avatar-border">
                                                <h4 class="mt-3">
                                                    <a href="javascript:void(0);">Judith H. Fritsche</a>
                                                </h4>
                                                <a href="javascript:void(0);" class="mb-1 d-inline-block"><i class="bx bx-location-plus text-danger fs-14 me-1"></i>SULLIVAN/Kentucky</a>
                                                <br>
                                                <a href="javascript:void(0);"><i class="bx bx-phone-call text-success fs-14 me-1"></i>305-5579-759</a>
                                                <br>
                                                <a href="#!" class="btn btn-sm btn-outline-primary mt-2">View All Details</a>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <img src="assets/images/users/avatar-5.jpg" alt="avatar-5" class="img-fluid avatar-xxl img-thumbnail rounded-circle avatar-border">
                                                <h4 class="mt-3">
                                                    <a href="javascript:void(0);">Peter T. Smith</a>
                                                </h4>
                                                <a href="javascript:void(0);" class="mb-1 d-inline-block"><i class="bx bx-location-plus text-danger fs-14 me-1"></i>Yreka/California</a>
                                                <br>
                                                <a href="javascript:void(0);"><i class="bx bx-phone-call text-success fs-14 me-1"></i>655-5187-93</a>
                                                <br>
                                                <a href="#!" class="btn btn-sm btn-outline-primary mt-2">View All Details</a>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <img src="assets/images/users/avatar-6.jpg" alt="avatar-6" class="img-fluid avatar-xxl img-thumbnail rounded-circle avatar-border">
                                                <h4 class="mt-3">
                                                    <a href="javascript:void(0);">Emmanuel J. Delcid</a>
                                                </h4>
                                                <a href="javascript:void(0);" class="mb-1 d-inline-block"><i class="bx bx-location-plus text-danger fs-14 me-1"></i>Atlanta/Georgia</a>
                                                <br>
                                                <a href="javascript:void(0);"><i class="bx bx-phone-call text-success fs-14 me-1"></i>693-5553-637</a>
                                                <br>
                                                <a href="#!" class="btn btn-sm btn-outline-primary mt-2">View All Details</a>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <img src="assets/images/users/avatar-7.jpg" alt="avatar-7" class="img-fluid avatar-xxl img-thumbnail rounded-circle avatar-border">
                                                <h4 class="mt-3">
                                                    <a href="javascript:void(0);">William J. Cook</a>
                                                </h4>
                                                <a href="javascript:void(0);" class="mb-1 d-inline-block"><i class="bx bx-location-plus text-danger fs-14 me-1"></i>Rosenberg/Texas</a>
                                                <br>
                                                <a href="javascript:void(0);"><i class="bx bx-phone-call text-success fs-14 me-1"></i>855-5446-150</a>
                                                <br>
                                                <a href="#!" class="btn btn-sm btn-outline-primary mt-2">View All Details</a>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <img src="assets/images/users/avatar-8.jpg" alt="avatar-8" class="img-fluid avatar-xxl img-thumbnail rounded-circle avatar-border">
                                                <h4 class="mt-3">
                                                    <a href="javascript:void(0);">Martin R. Peters</a>
                                                </h4>
                                                <a href="javascript:void(0);" class="mb-1 d-inline-block"><i class="bx bx-location-plus text-danger fs-14 me-1"></i>Youngstown/Ohio</a>
                                                <br>
                                                <a href="javascript:void(0);"><i class="bx bx-phone-call text-success fs-14 me-1"></i>455-5943-13</a>
                                                <br>
                                                <a href="#!" class="btn btn-sm btn-outline-primary mt-2">View All Details</a>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <img src="assets/images/users/avatar-9.jpg" alt="avatar-9" class="img-fluid avatar-xxl img-thumbnail rounded-circle avatar-border">
                                                <h4 class="mt-3">
                                                    <a href="javascript:void(0);">Paul M. Schubert</a>
                                                </h4>
                                                <a href="javascript:void(0);" class="mb-1 d-inline-block"><i class="bx bx-location-plus text-danger fs-14 me-1"></i>Austin/Texas</a>
                                                <br>
                                                <a href="javascript:void(0);"><i class="bx bx-phone-call text-success fs-14 me-1"></i>035-5531-64</a>
                                                <br>
                                                <a href="#!" class="btn btn-sm btn-outline-primary mt-2">View All Details</a>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <img src="assets/images/users/avatar-10.jpg" alt="avatar-10" class="img-fluid avatar-xxl img-thumbnail rounded-circle avatar-border">
                                                <h4 class="mt-3">
                                                    <a href="javascript:void(0);">Janet J. Champine</a>
                                                </h4>
                                                <a href="javascript:void(0);" class="mb-1 d-inline-block"><i class="bx bx-location-plus text-danger fs-14 me-1"></i>Nashville/Tennessee</a>
                                                <br>
                                                <a href="javascript:void(0);"><i class="bx bx-phone-call text-success fs-14 me-1"></i>115-5592-916</a>
                                                <br>
                                                <a href="#!" class="btn btn-sm btn-outline-primary mt-2">View All Details</a>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                    </div>
                </div>
@endsection

