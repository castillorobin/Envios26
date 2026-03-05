@extends('layouts.app')

@section('content')

<style>
    /* Estilo para integrar DataTables con el diseño de la plantilla */
    .dataTables_length select {
        padding: 5px 10px;
        border-radius: 5px;
        border: 1px solid #e1e3ea;
    }
    .dataTables_info, .dataTables_paginate {
        margin-top: 15px !important;
    }
    /* Ocultar el buscador por defecto de DataTables */
    .dataTables_filter {
        display: none;
    }
    /* Ajuste de ancho de tu buscador personalizado */
    .search-bar input {
        width: 250px !important;
    }
</style>

<style>
    /* Forzar el estilo redondeado de Reback en los botones de DataTables */
    .pagination-rounded .page-item .page-link {
        border-radius: 50% !important;
        margin: 0 3px !important;
        border: none;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
    }

    .pagination-rounded .page-item.active .page-link {
        background-color: #3e60d5 !important; /* Azul primario de Reback */
        color: white !important;
        box-shadow: 0 2px 6px 0 rgba(62, 96, 213, 0.5);
    }

    /* Ajuste para los botones 'Anterior' y 'Siguiente' para que no sean círculos perfectos */
    .pagination-rounded .page-item:first-child .page-link,
    .pagination-rounded .page-item:last-child .page-link {
        border-radius: 5px !important;
        width: auto !important;
        padding: 0 15px;
    }
</style>

<style>
    /* Aseguramos que la info y paginación no tengan márgenes extra al estar fuera */
    .dataTables_info, .dataTables_paginate {
        margin-top: 0 !important;
        padding-top: 0 !important;
    }

    #dt-pagination-container .dataTables_paginate {
        display: flex;
        justify-content: flex-end;
    }
    
    /* Evita que el contenedor de la tabla se vea vacío si se mueven los elementos */
    .dataTables_wrapper {
        padding: 0 !important;
    }

    /* Evitar saltos visuales al mover elementos */
    #dt-info-container, #dt-pagination-container {
        min-height: 40px;
        display: flex;
        align-items: center;
    }

    .dataTables_info {
        margin-top: 0 !important;
        font-size: 0.875rem;
        color: #6c757d;
    }
</style>

<style>
    /* Ocultar el buscador original por si acaso */
    .dataTables_filter { display: none !important; }

    /* Forzar el estilo redondeado de Reback */
    .pagination-rounded .page-item .page-link {
        border-radius: 50% !important;
        margin: 0 3px !important;
        border: none;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
    }

    /* Color azul oficial de Reback para el botón activo */
    .pagination-rounded .page-item.active .page-link {
        background-color: #3e60d5 !important; 
        color: white !important;
        box-shadow: 0 2px 6px 0 rgba(62, 96, 213, 0.5);
    }

    .pagination-rounded .page-item:first-child .page-link,
    .pagination-rounded .page-item:last-child .page-link {
        border-radius: 5px !important;
        width: auto !important;
        padding: 0 15px;
    }

    /* Contenedores externos */
    #dt-info-container .dataTables_info {
        margin-top: 0 !important;
        padding: 0 !important;
        font-size: 0.875rem;
    }

    #dt-pagination-container .dataTables_paginate {
        margin-top: 0 !important;
        padding: 0 !important;
    }
</style>





<div class="container-xxl"> 



                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="mb-0 fw-semibold">Listado de movimientos de caja</h4>
                                
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                                        <div>
                                             <div class="d-flex gap-2">
                                                <input type="text" id="search" class="form-control" style="max-width: 400px;" placeholder="Buscar" autofocus>
                                               
                                            </div>
                                           
                                        </div>
                                         <div>
                                           
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




                    <div class="row">
                        
                        <!-- end col -->
                                    <div class="col-xl-12">
                                         <div >
                                    <div class="card-body">
                                        <div class="row">
                                        
                                        </div>
                                    </div>

                                     <div class="tab-content pt-0">
                        <div class="tab-pane show active" id="team-list" role="tabpanel">
                            
                            <div class="card overflow-hidden">


                                    <div class="bg-light-subtle border-bottom p-2">
                                        <label style="font-weight: bold; margin-bottom: 0; ">
                                        
                                                <i class="bx bx-receipt me-1 text-primary"></i> Movimientos de: <span class="text-primary">{{ $cajas[0]->cajero }}</span>
                                        
                                        </label>
                                    </div>

                                    <div class="table-responsive table-centered mt-3">
                                       <table class="table text-nowrap mb-0" id="tabla-lote">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="text-center">Fecha</th>
                                                <th class="text-center">Hora</th>
                                                <th class="text-center">Concepto</th>
                                                <th class="text-center">Entrada</th>
                                                <th class="text-center">Salida</th>
                                                <th class="text-center">Saldo</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <!-- end thead-->
                                        <tbody>

                                            @foreach ($cajas as $caja) 
                                                <tr class="'table-row-gray' : 'table-row-white' ">
                                                        <td class="text-center"> 
                                                        {{ date('d/m/Y', strtotime($caja->created_at)) }}
                                                        </td>
                                                        <td class="text-center">{{ date('h:i A', strtotime($caja->created_at)) }}</td>
                                                        
                                                        <td class="text-center">{{ $caja->concepto }}</td>
                                                        <td class="text-center">
                                                        @if ($caja->tipo == "Entrada")
                                                            $ {{ $caja->valor }}
                                                            @elseif ($caja->tipo == "Caja inicial")
                                                                $ {{ $caja->valor }}
                                                            @else
                                                                $ 0.00
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if ($caja->tipo == "Salida")
                                                            $ {{ $caja->valor }}
                                                            @elseif ($caja->tipo == "Cierre de caja")
                                                                $ {{ $caja->valor }}
                                                            @else
                                                                $ 0.00
                                                            @endif
                                                        </td>
                                                        <td class="text-center">$ {{$caja->saldo}}</td>
                                                       
                                                        </tr>
                                            @endforeach
                                          
                                           
                                            
                                        </tbody>
                                        <!-- end tbody -->
                                    </table>

                                       
                                    </div>

                                    <div class="card-footer bg-transparent border-top">
                                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                                <div id="dt-info-container"></div>
                                                <div id="dt-pagination-container"></div>
                                            </div>
                                    </div>
                                    <!-- end table responsive -->
                                     <hr>


                                     <div class="row g-0">
                                                            <div class="col-sm-4">
                                                                <div class="bg-body border-end">
                                                                    <div class="text-center p-3">
                                                                        <div class="avatar-sm mx-auto mb-2">
                                                                            <span class="avatar-title bg-primary-subtle text-primary rounded-circle"><iconify-icon icon="iconamoon:category-duotone" class="fs-18"><template shadowrootmode="open"><style data-style="data-style">:host{display:inline-block;vertical-align:0}span,svg{display:block}</style><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none"><circle cx="17" cy="7" r="3" fill="currentColor" opacity=".16"></circle><circle cx="7" cy="17" r="3" fill="currentColor" opacity=".16"></circle><path fill="currentColor" d="M14 14h6v5a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zM4 4h6v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1z" opacity=".16"></path><circle cx="17" cy="7" r="3" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle><circle cx="7" cy="17" r="3" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 14h6v5a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zM4 4h6v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1z"></path></g></svg></template></iconify-icon></span>
                                                                        </div>
                                                                        <h4 class="fw-semibold fs-20 mb-1">
                                                                            $ {{$cajapr[0]->saldo}}
                                                                        </h4>
                                                                        <h5 class="fs-14 mb-0">
                                                                            Saldo en caja al cierre
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end col -->
                                                            <div class="col-sm-4">
                                                                <div class="bg-body border-end">
                                                                    <div class="text-center p-3">
                                                                        <div class="avatar-sm mx-auto mb-2">
                                                                            <span class="avatar-title bg-success-subtle text-success rounded-circle"><iconify-icon icon="iconamoon:check-circle-1-duotone" class="fs-18"><template shadowrootmode="open"><style data-style="data-style">:host{display:inline-block;vertical-align:0}span,svg{display:block}</style><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none"><circle cx="12" cy="12" r="9" fill="currentColor" opacity=".16"></circle><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 10l-4 4l-2-2"></path></g></svg></template></iconify-icon></span>
                                                                        </div>
                                                                        <h4 class="fw-semibold fs-20 mb-1">
                                                                            $ {{$cajapr[0]->saldocajero}}
                                                                        </h4>
                                                                        <h5 class="fs-14 mb-0">
                                                                            Saldo en cajero
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end col -->
                                                            <div class="col-sm-4">
                                                                <div class="bg-body">
                                                                    <div class="text-center p-3">
                                                                        <div class="avatar-sm mx-auto mb-2">
                                                                            <span class="avatar-title bg-danger-subtle text-danger rounded-circle"><iconify-icon icon="iconamoon:credit-card-duotone" class="fs-18"><template shadowrootmode="open"><style data-style="data-style">:host{display:inline-block;vertical-align:0}span,svg{display:block}</style><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none"><path fill="currentColor" d="M5 19h14a2 2 0 0 0 2-2V9H3v8a2 2 0 0 0 2 2" opacity=".16"></path><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9h18M3 5h18v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2zm4 8h3"></path></g></svg></template></iconify-icon></span>
                                                                        </div>
                                                                        <h4 class="fw-semibold fs-20 mb-1">
                                                                            @if($cajapr[0]->descuadre > 0 )
                                                                            <span style="color:red;"> $ -{{$cajapr[0]->descuadre}} </span>
                                                                            @else
                                                                            <span > $ {{$cajapr[0]->descuadre}} </span>
                                                                            @endif
                                                                        </h4>
                                                                        <h5 class="fs-14 mb-0">
                                                                            Descuadre
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end col -->
                                                        </div>


                                     <hr>

                                    

                                            <div style="margin-right: 40px; margin-top: 20px; margin-bottom: 20px; display: flex; justify-content: flex-end; gap: 10px;">
                                            @if($caja->concepto != "Cierre de caja" )
                                            <a href="#" class="btn btn-sm fw-bold btn-danger" data-bs-toggle="modal" data-bs-target="#kt_modal_stacked_1">
                                                        Cerrar caja       </a>
                                            @endif

                                            <a href="/caja/cuadre" class="btn btn-sm fw-bold btn-primary" >
                                                        Regresar       </a>
                                            <!--end::Regresar-->

                                           

                                    </div>
                                </div>
                                <!-- end card body -->
                            
                        </div>
                        <!-- end col -->




                        




                    </div>
</div>


</div></div></div>








<div class="modal fade" tabindex="-1" id="kt_modal_stacked_1">
<div class="modal-dialog modal-dialog-centered">
     
    <div class="modal-content">
        <div class="modal-header">
           <h3 class="modal-title">Cerrar caja</h3>
<form action="/caja/guardar" method="GET">
     
            <!--begin::Close-->
            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
            </div>
            <!--end::Close-->
        </div>

        <div class="modal-body">
            
           <input type="text" name="cajero" class="form-control form-control-solid" value="{{ Auth::user()->name }}" readonly />
           <br>
            <input type="text" class="form-control form-control-solid" value="{{ date("d/m/Y") }}" readonly />
            
            
            <br>
          
              <select class="form-select form-select-solid" aria-label="Select example" name="concepto" id="select-concepto"> 
    
    
     @foreach ($conceptos as $concepto)
     @if($concepto->concepto == "Cierre de caja")
    <option value="{{$concepto->id}}">{{$concepto->concepto}}</option>
    @endif
    @endforeach
   
</select>




            <br>
                       
            <div class="row">
                <div class="col">
                    <div id="input-cierre-wrapper2" class="mt-3">
                         
                             <label for="valor_caja" class="form-label">Saldo en caja</label>
                            @isset($caja->saldo)
                               <input type="text" name="valor_caja" id="valor_caja" class="form-control form-control-solid" placeholder="Saldo caja" value="{{$caja->saldo}}" readonly>
                            @endisset


                    </div>
                </div>
                <div class="col">
            <!-- Input oculto al principio -->
                    <div id="input-cierre-wrapper"  class="mt-3">
                        <label for="valor_cierre" class="form-label">Saldo de cajero</label>
                        <input type="text" name="valor_cierre" id="valor_cierre" class="form-control form-control-solid" placeholder="Saldo cajero">

                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-6">
                
            <div id="input-saldo-final-wrapper" class="mt-3">
               <label for="saldo_final" class="form-label">Descuadre</label>
                    <input type="number" name="saldo_final" id="saldo_final" class="form-control form-control-solid" placeholder="$0.00" readonly>
            </div>

              </div>
            </div>



        </div>



        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>
</div>
</div>






<script>
    window.onload = function() {
        if (typeof jQuery !== 'undefined') {
            $(document).ready(function() {
                var table = $('#tabla-lote').DataTable({
                    "paging": true,
                    "info": true,
                    "pageLength": 10,
                    "lengthMenu": [5, 10, 25, 50],
                    "order": [[ 0, "asc" ]],
                    // 't' es tabla, 'i' es info, 'p' es paginación. 
                    // Los incluimos para que se generen y podamos moverlos.
                    "dom": 'tip', 
                    "language": {
                        "url": "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json",
                        "paginate": {
                            "previous": "<i class='bx bx-chevron-left'></i>",
                            "next": "<i class='bx bx-chevron-right'></i>"
                        }
                    },
                    "drawCallback": function(settings) {
                        // 1. Aplicamos el diseño redondeado de Reback
                        $('.dataTables_paginate > ul.pagination').addClass('pagination-rounded');
                        
                        // 2. MOVER los controles a tus contenedores externos
                        var api = this.api();
                        var container = $(api.table().container());
                        
                        // Inyectamos los elementos dentro de tus contenedores específicos
                        $('#dt-info-container').append(container.find('.dataTables_info'));
                        $('#dt-pagination-container').append(container.find('.dataTables_paginate'));
                    }
                });

                // Buscador personalizado
                $('#search').on('keyup', function() {
                    table.search(this.value).draw();
                });
            });
        }
    };
</script>


    
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectConcepto = document.getElementById('select-concepto');
        const inputWrapper = document.getElementById('input-cierre-wrapper');
        const inputWrapper2 = document.getElementById('input-cierre-wrapper2');
        const inputWrapper3 = document.getElementById('input-cierre-wrapper3');
        const inputSaldoFinal = document.getElementById('saldo_final');
        const inputSaldoFinalWrapper = document.getElementById('input-saldo-final-wrapper');
        const inputCierre = document.getElementById('valor_cierre');
        const inputcaja = document.getElementById('valor_caja');

        selectConcepto.addEventListener('change', function () {
            // Obtener el texto de la opción seleccionada
            const selectedText = selectConcepto.options[selectConcepto.selectedIndex].text;
            

            // Verificar si contiene "Cierre de caja"
            if (selectedText.includes('Cierre de caja')) {
                inputWrapper.style.display = 'block'; // Mostrar input
                inputWrapper2.style.display = 'block';
                inputWrapper3.style.display = 'none';
                inputSaldoFinalWrapper.style.display = 'block';

            } else {
                inputWrapper.style.display = 'none'; // Ocultar input
                inputWrapper2.style.display = 'none';
                inputWrapper3.style.display = 'block';
                inputSaldoFinalWrapper.style.display = 'none';
                inputSaldoFinal.value = '';
            }
        });


         // Calcular saldo final en tiempo real
        inputCierre.addEventListener('input', function () {
            const saldoCaja = parseFloat(inputcaja.value) || 0;
            const valorCierre = parseFloat(inputCierre.value) || 0;
            const saldoFinal = saldoCaja - valorCierre;

            inputSaldoFinal.value = saldoFinal.toFixed(2);
        });
    });
</script>

@endsection