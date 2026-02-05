@extends('layouts.app')

@section('content')




<div class="container-xxl">
                    <!-- ========== Page Title Start ========== 
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="mb-0 fw-semibold">Create Product</h4>
                                
                            </div>
                        </div>
                    </div>
                    -->
                    <!-- ========== Page Title End ========== -->


                    <div class="row">
                        <div class="col">
                            <div class="card" id="horizontalwizard">
                                <div class="card-header">
                                    


                                    <div style="width: 40%;">
                                        <form action="{{ route('ordenes.procesar_busqueda') }}" method="POST" id="form-busqueda">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label">Escanear o Ingresar Guía</label>
                                                <div class="input-group">
                                                    <input type="text" name="guia" id="guia_input" 
                                                        class="form-control form-control-lg" 
                                                        placeholder="Código de guía..." 
                                                        autofocus required>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="bx bx-search-alt"></i>
                                                    </button>

                                                    <div class="d-grid gap-2" style="margin-left: 10px;">
                                                        <button type="button" id="btn-activar-qr" class="btn btn-outline-secondary btn-lg">
                                                            <i class="bx bx-qr-scan me-1"></i> Escanear por QR
                                                        </button>
                                                    </div>
                                                </div>

                                                

                                            </div>

                                            <div id="reader-container" class="d-none border rounded bg-light mb-3">
                                                <div id="reader" style="width: 100%;"></div>
                                                <div class="p-2 text-center">
                                                    <button type="button" id="btn-cerrar-camara" class="btn btn-sm btn-danger">
                                                        Cerrar Cámara
                                                    </button>
                                                </div>
                                            </div>

                                            
                                        </form>
                                    </div>








                                    <ul class="nav nav-tabs card-header-tabs border-0" role="tablist">
                                       
                                        <!-- end nav item -->
                                        <li class="nav-item" data-target-form="#productImagesForm" role="presentation">
                                            <a href="#productImages" data-bs-toggle="tab" data-toggle="tab" class="nav-link pb-3 active" aria-selected="true" role="tab">
                                                <i class="bx bx-images me-1"></i>
                                                <span class="d-none d-sm-inline">Toma de fotografia</span>
                                            </a>
                                        </li>
                                        <!-- end nav item -->
                                    
                                       
                                    </ul>
                                    <!-- nav pills -->
                                </div>
                                <div class="card-body">
                                    <div class="tab-content pt-0">
                                        
                                        <!-- end contact detail tab pane -->
                                        <div class="tab-pane active show" id="productImages" role="tabpanel">
                                            <h5 class="fs-14 mb-1">
                                                Fotos de la orden
                                            </h5>
                                            <p class="text-muted fs-13">
                                                Agregar fotos a la orden.
                                            </p>
                                            <form action="/" method="post" class="dropzone dz-clickable" id="productImagesForm" data-plugin="dropzone" data-previews-container="#file-previews" data-upload-preview-template="#uploadPreviewTemplate">
                                                

                                                <div class="dz-message needsclick">
                                                    <i class="h1 bx bx-cloud-upload"></i>
                                                    <h3>
                                                        Click o tab para subir fotos.
                                                    </h3>
                                                    <span class="text-muted fs-13">
                                                      
                                                        
                                                    </span>
                                                </div>
                                            
                                        </div>
                                        <!-- end job detail tab pane -->
                                        
                                        <!-- end education detail tab pane -->
                                        
                                        <div class="d-flex flex-wrap gap-2 wizard justify-content-between mt-3">
                                            
                                            <div class="last" style="margin-left: auto;">
                                                <button type="button" class="btn btn-secondary"><i class="bx bx-x me-1"></i> Cancelar</button>
                                                <button type="submit" class="btn btn-primary"><i class="bx bx-save me-1"></i> Guardar</button>
                                            </div>
                                        </div>

                                        </form>
                                    </div>
                                    <!-- end tab content-->                              </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>








@endsection