@extends('layouts.app')

@section('content')
<style>
    .modal-backdrop {
  z-index: 0;
}

.headt td {
  height: 15px !important;
  padding: 0px;
 font-size: 14px;
 background: #ffffff;
}


.cambiar {
   
   float: left;
   
     
   }

.cambiar2 {
   float: right;
   margin-right: 20px;
  
  /*
   
   margin-right: 300px;
   margin-bottom: 15px; 
   margin-top: -15px; 
   
   */
}

.pagina1{
    margin-bottom: 30px;
    margin-top: -30px;
    
}
.pagina2{
    
    margin-bottom: -25px;
    padding-top: 10px;
    
}




</style>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>  
jQuery(document).ready(function($){
    $(document).ready(function() {
        $('.mi-selector').select2();
       
        $('#comer').on('select2:select', function (e) { 
            
            var data = e.params.data;
    //console.log(data.text);
    //document.getElementById('mostrar').value = data.text;
    window.location = "https://appmeloexpress.com/factura/listadofiltro/" + data.text; 
    //window.location = "http://127.0.0.1:8000/factura/listadofiltro/" + data.text;
        });

    });
   
   
});



</script>
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Melo Express</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card"> 
                        <div class="card-body">

                            <h3 class="text-center">Detalles de Pagos</h3>
                        
            <div class="row  py-2" style="background-color: white;" >   <!-- Inicia fila General -->
           

                <div class="col-12">   <!-- Inicia columna 8  -->
                
                <div class="row mt-1 border mr-1">   
                
                <div class="col-sm-6 mt-4"> <!-- div buscar -->

<div class="input-group mb-3 ">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1"> <i class="fas fa-search"></i> </span>
</div>

<select class="form-control mi-selector" name="comer" id="comer">
    <option value="">Buscar Comercio</option>
    @for($i=0;  $i< count($vendedores); $i++ )
                    <option value="{{$vendedores[$i]->nombre}}">{{ $vendedores[$i]->nombre }} </option>
       
                        @endfor
</select>

</div>
</div> <!-- Termina div buscar  -->


<div class="col-6 mt-4">  <!-- div filtrros  -->
<a href="/facturas" class="btn btn-danger" style="float:right;">Cerrar</a>

<span style="font-size:18px; color: red;"> {{ $nota }} &nbsp; </span>

                </div> <!-- Termina div filtros  -->

<div class="col-12 table-responsive " style="height:500px; " > <!-- div tabla  -->
<table id="tvendedor" class="table table-striped " style="  ">
<thead style="background-color:#6777ef;"> 
    <tr >
        
        <th style="color: #fff;">Comercio</th>
        <th style="color: #fff;">Destinatario</th>
        <th style="color: #fff;">Dirección</th>
        <th style="color: #fff;">Tipo</th>
        <th style="color: #fff;">Estado del envio</th>
        <th style="color: #fff;">Fecha de entrega</th>
        <th style="color: #fff;">Estado del pago</th>
        <th style="color: #fff;">Precio del paquete</th>
        <th style="color: #fff;">Precio del envio</th>
        <th style="color: #fff;">Total</th>
        <th style="color: #fff;">Agencia</th>
     
        <th style="color: #fff;">Opciones</th>
    </tr>
</thead>
<tbody> 


@for($i=0;  $i< count($pedidos); $i++ )
<tr>
                    
                    <td>{{ $pedidos[$i]->vendedor }} </td>
                    <td>{{ $pedidos[$i]->destinatario }} </td>
                    <td>{{ $pedidos[$i]->direccion }} </td>
                    <td>{{ $pedidos[$i]->tipo }}</td>  
                    <td >{{ $pedidos[$i]->estado }}</td>
                    <td>{{  date('d/m/Y', strtotime($pedidos[$i]->fecha_entrega))}} </td>

                    @if($pedidos[$i]->pagado=='Pagado')
                    <td class="text-center"><h5><span class="badge badge-success ">{{ $pedidos[$i]->pagado }} </span></h5></td>
                    @else
                    <td class="text-center"><h5><span class="badge badge-danger ">{{ $pedidos[$i]->pagado }} </span></h5></td>
                    @endif

                   
                    <td>{{ $pedidos[$i]->precio }}  </td>
                   
                    <td>{{ $pedidos[$i]->envio }} </td>
                    
                    <td>{{ $pedidos[$i]->total }} </td>
                    <td>{{ $pedidos[$i]->agencia }} </td>
                   
   

    


                    <td class="opciones text-center" style="">

  

<button type="button" class="edit btn btn-warning" data-toggle="modal" value="{{ $pedidos[$i]->detallep }}" data-target="#exampleModal" >Detalles</button>
  <!--
 
    <a href="" class="dropdown-toggle" data-toggle="dropdown">

    <i class="fas fa-list"></i></a>
    <ul class="dropdown-menu" style="background-color: #ffffff;"> 
    @can('editar-rol')
     <div class="botones"> 

    <li class="botones">
    &nbsp;
    <i class="fas fa-edit"></i>
    &nbsp;&nbsp;
    <a href="/pedido/editando/{{ $pedidos[$i]->id }}" >Editar</a></li> 
    </div>  
    @endcan
	<li class="botones">
   
    &nbsp;
    <i class="fas fa-eye"></i>
    &nbsp;&nbsp;
    <button type="button" class="edit" data-toggle="modal" value="{{ $pedidos[$i]->id }}" data-target="#exampleModal2" style="background: none; border: 0;">Ver</button>

</li>
@can('crear-rol')
<li class="botones">
    <form action="{{ route ('pedidos.destroy', $pedidos[$i]->id)}}" method="POST">
        @csrf
        @method('DELETE')
        &nbsp;
        <i class="fas fa-trash-alt"></i> 
        &nbsp;&nbsp;
        <button style="background: none; border: 0;">Eliminar</button>
        </form>
        </li>
        @endcan
    </ul>
-->

    </td>




                    </tr>
                        @endfor

                        @for($i=0;  $i< count($facturas); $i++ )
                        <span hidden id="caj{{ $facturas[$i]->id }}"> {{ $facturas[$i]->cajero }}</span>
                        <span hidden id="med{{ $facturas[$i]->id }}"> {{ $facturas[$i]->medio }}</span>
                        <span hidden id="fec{{ $facturas[$i]->id }}"> {{ $facturas[$i]->fechapago }}</span>
                        <span hidden id="tip{{ $facturas[$i]->id }}"> {{ $facturas[$i]->tipo }}</span>
                        <span hidden id="num{{ $facturas[$i]->id }}"> {{ $facturas[$i]->numerocompro }}</span>
                        <span hidden id="des{{ $facturas[$i]->id }}"> {{ $facturas[$i]->descuento }}</span>
                        <span hidden id="not{{ $facturas[$i]->id }}"> {{ $facturas[$i]->nota }}</span>

                        @endfor

</tbody> 

<tr>

    <td  ></td>
    <td  ></td>
    <td  ></td>
    <td  ></td>
    <td  ></td>
    <td  ></td>
    <td  ></td>
    <td  ></td>
    <td  ></td>
    <td  ></td>
    <td  ></td>
    <td  ></td>
</tr>





</table>

</div><!-- termina div tabla  -->


                </div> <!-- Termina columna 12 -->
     
                </div>  <!-- Termina columna 8  -->
             
            </div> <!-- Termina fila General -->
                            
         
            
            
            <!-- Empieza Modal -->

            <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detalles de Pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      <div class="row p-3 m-3" style="border: solid 1px;">
           
           <table class="table table-borderless" >
               

               <tr class="headt">
                    <td width="230px">Cajero </td>
                    <td> <span ></span> <label for="" id="cajer"></label> </td>
                    
                </tr>
                <tr class="headt">
                    <td width="230px">Medio</td>
                    <td> <span ></span> <label for="" id="medio"></label> </td>
                    
                </tr>
                <tr class="headt">
                    <td width="230px">Fecha </td>
                    <td> <span ></span> <label for="" id="fechaa"></label> </td>
                    
                </tr>
                <tr class="headt">
                    <td width="230px">Tipo de Comprobante </td>
                    <td> <span ></span> <label for="" id="tipoo"></label> </td>
                    
                </tr>
                <tr class="headt">
                    <td width="230px">Numero de Comprobante </td>
                    <td> <span ></span> <label for="" id="numer"></label> </td>
                    
                </tr>
                <tr class="headt">
                    <td width="230px">Descuento </td>
                    <td> <span ></span> <label for="" id="descu"></label> </td>
                    
                </tr>
                <tr class="headt">
                    <td width="230px">Nota</td>
                    <td> <span ></span> <label for="" id="notaa"></label> </td>
                    
                </tr>
</table>
</table>
</table>
      </div>
      </div>
      <div class="modal-footer " style="background-color:white;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>


            <!-- Termina Modal -->






                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>


   
<script src="https://kit.fontawesome.com/b64093b700.js" crossorigin="anonymous"></script> 




<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" defer></script>

    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js" defer></script>

                 
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" defer></script>


         <script>
 
 $(document).ready(function(){
           $(document).on('click', '.edit', function(){
               var id=$(this).val();
               var caje=$('#caj'+id).text();
               var medi=$('#med'+id).text();
               var fech=$('#fec'+id).text();
               var tipo=$('#tip'+id).text();
               var nume=$('#num'+id).text();
               var desc=$('#des'+id).text();
               var nota=$('#not'+id).text();

               $('#edit').modal('show');
               $('#cajer').text(caje);
               $('#medio').text(medi);
               $('#fechaa').text(fech);
               $('#tipoo').text(tipo);
               $('#numer').text(nume);
               $('#descu').text(desc);
               $('#notaa').text(nota);


            });
       });


       
$(document).ready(function() {

$('#tvendedor').DataTable( {
  language: {
      "decimal": "",
      "emptyTable": "No hay información",
      "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
      "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
      "infoFiltered": "(Filtrado de _MAX_ total entradas)",
      "infoPostFix": "",
      "thousands": ",",
      "lengthMenu": "Mostrar _MENU_ Entradas",
      "loadingRecords": "Cargando...",
      "processing": "Procesando...",
      "search": "Buscar:",
      "zeroRecords": "Sin resultados encontrados",
      "paginate": {
          "first": "Primero",
          "last": "Ultimo",
          "next": "Siguiente",
          "previous": "Anterior"
      }
  },
      
      dom: '<"cambiar"f><"pagina2"p><"cambiar2"l>tri<"pagina1"p>',
         

  //responsive: true



} );



} );
        </script> 
@endsection
