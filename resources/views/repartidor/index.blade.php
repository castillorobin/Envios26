@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Melo Express</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card"> 
                        <div class="card-body">

                        <style>
    .dropdown-menu-center {
  left: 50% !important;
  /*right: auto !important;*/
  text-align: center !important;
  transform: translate(-50%, 0) !important;
        margin-top: 15px;
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
.nocolor a:link, a:visited, a:active {
    text-decoration:none; 
    color:black;
            
        }

        .dataTables_paginate a:hover {
    color: white !important;
    background:#0d6efd !important;
    
}

.opciones li {
 display: block;
 transition-duration: 0.5s;
text-align: left;
 
}

.opciones li:hover {
  cursor: pointer;
  background:#b2b2b2;
}

.opciones ul li ul {
  visibility: hidden;
  opacity: 0;
  position: absolute;
  transition: all 0.5s ease;
  margin-top: 1rem;
  left: 0;
  display: none;
  
}

.opciones ul li:hover > ul,
ul li ul:hover {
  visibility: visible;
  opacity: 1;
  display: block;
  
}

.dt-buttons button {
    background: #0275d8;
    color: white;
    border-radius: 5px;
    font-size: 16px;
    float: right;
}
.headt td {
  height: 15px !important;
  padding: 0px;
 font-size: 14px;
 background: #ffffff;
}
.modal-backdrop {
  z-index: -1;
}
</style>



<div class="row" style="background-color: white;" >

   
    <div class="  col-sm-12 py-3">
        <h3 class="text-center">Listado de empleados</h3>
    </div>

   

<div class="col-12">


<div class="d-flex justify-content-end">
@can('crear-empleados')
<div >
<a href="/repartidores/create" class="btn btn-warning " style="color:white;"><i class="fas fa-database"></i> Agregar Empleado</a>
    <br>

</div>
@endcan

</div>









  <div class="table-responsive" >
<table id="trepartidor" class="table table-striped mt-2" >
<thead style="background-color:#6777ef;">
    <tr >
      
     
       
        <th style="color: #fff;">Nombre</th>
        <th style="color: #fff;">Telefono</th> 
        <th style="color: #fff;">Direccion</th>
        <th style="color: #fff;">Fecha de alta</th>
        <th style="color: #fff;">Cargo</th>
       
        <th style="color: #fff;">Agencia</th>
        <th style="color: #fff;">Nota</th>
        <th style="color: #fff;">Opciones</th>
        
    </tr>
</thead>
<tbody>
@for ($i=0; $i< count($repartidores); $i++)
      
         
    <td><span id="nombre{{$repartidores[$i]->id}}">{{ $repartidores[$i]->nombre }}</span></td>
    <td><span id="tele{{$repartidores[$i]->id}}">{{ $repartidores[$i]->telefono }}</span></td>
    <td><span id="dire{{$repartidores[$i]->id}}">{{ $repartidores[$i]->direccion }}</span></td>
    <td>{{ date("d/m/Y", strtotime($repartidores[$i]->fecha_de_alta)) }}</td>
    <td>{{ $repartidores[$i]->cargo }}</td>
   
    <td>{{ $repartidores[$i]->agencia }}</td>
    <td>{{ $repartidores[$i]->nota }}</td>    
    <span hidden id="correo{{ $repartidores[$i]->id }}"> {{ $repartidores[$i]->correo }}</span>
    <span hidden id="dui{{ $repartidores[$i]->id }}"> {{ $repartidores[$i]->dui }}</span>
    <span hidden id="nit{{ $repartidores[$i]->id }}"> {{ $repartidores[$i]->nit }}</span>
    <span hidden id="tipoc{{ $repartidores[$i]->id }}"> {{ $repartidores[$i]->tipo_contrato }}</span>
    <span hidden id="agencia{{ $repartidores[$i]->id }}"> {{ $repartidores[$i]->agencia }}</span>
    <span hidden id="isss{{ $repartidores[$i]->id }}"> {{ $repartidores[$i]->num_seguro }}</span>
    <span hidden id="afp{{ $repartidores[$i]->id }}"> {{ $repartidores[$i]->num_afp }}</span>
    <span hidden id="cargo{{ $repartidores[$i]->id }}"> {{ $repartidores[$i]->cargo }}</span>
    <span hidden id="falta{{ $repartidores[$i]->id }}"> {{ $repartidores[$i]->fecha_de_alta }}</span>
    <span hidden id="sala{{ $repartidores[$i]->id }}"> {{ $repartidores[$i]->salario }}</span>
    <span hidden id="fbaja{{ $repartidores[$i]->id }}"> {{ $repartidores[$i]->fecha_de_baja }}</span>
    <span hidden id="nota{{ $repartidores[$i]->id }}"> {{ $repartidores[$i]->nota }}</span>
    <span hidden id="tvehi{{ $repartidores[$i]->id }}"> {{ $repartidores[$i]->tipo_vehiculo }}</span>
    <span hidden id="equipo{{ $repartidores[$i]->id }}"> {{ $repartidores[$i]->asigno_unidad }}</span>
    <span hidden id="placa{{ $repartidores[$i]->id }}"> {{ $repartidores[$i]->num_placa }}</span>
    <span hidden id="tarjeta{{ $repartidores[$i]->id }}"> {{ $repartidores[$i]->num_tarjeta }}</span>
    <span hidden id="licencia{{ $repartidores[$i]->id }}"> {{ $repartidores[$i]->num_licencia }}</span>
    <span hidden id="foto{{ $repartidores[$i]->id }}"> /imgs/fotos/{{ $repartidores[$i]->foto }}</span>

 

    <td class="opciones text-center" style="">
    
    @can('crear-rol')
   
 
    <a href="" class="dropdown-toggle" data-toggle="dropdown">

    <i class="fas fa-list"></i></a>
    <ul class="dropdown-menu" style="background-color: #ffffff;">
     <div class="botones"> 
     
    <li class="botones">
    &nbsp;
    <i class="fas fa-edit"></i>
    &nbsp;&nbsp;
    <a href="/repartidores/{{ $repartidores[$i]->id }}/edit" ><button style="background: none; border: 0;">Editar</button></a></li> 
  
    </div>  
	<li class="botones">
    <form >
   
    &nbsp;
    <i class="fas fa-eye"></i>
    &nbsp;&nbsp;
    <button type="button" class="edit" data-toggle="modal" value="{{ $repartidores[$i]->id }}" data-target="#exampleModal" style="background: none; border: 0;">Ver</button>
  
    
    </form>
            </li>
            
        <li class="botones">
    <form action="{{ route ('repartidores.destroy', $repartidores[$i]->id)}}" method="POST">
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
 
   
    </td>

    </tr>
    @endfor
</tbody>
</table>
</div>



<!-- Inicio Modal -->
 
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel" style="float: left;"></h1> &nbsp; &nbsp; &nbsp;
        <span style="float: right; text-align: right;"><button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button></span>
      </div>
      <div class="modal-body">
        <div class="row p-3 m-3" style="border: solid 1px;">
           
            <table class="table table-borderless" >
                <tr>
                    <td  colspan="3"><h4>Informacion del empleado </h4>
                        <hr>
                    </td>
                    
                </tr>
                <tr class="headt">
                    <td width="230px">Nombre del empleado </td>
                    <td> <span ></span> <label for="" id="efirstname"></label> </td>
                    <td rowspan="8"> <span ></span> <label for="" > </label> <img  alt="" class="img-thumbnail" id="fotos" width="250"> </td>
                </tr>
                <tr class="headt">
                    <td width="230px">Dirección </td>
                    <td> <span ></span> <label for="" id="dire"></label> </td>
                    
                </tr>
                <tr class="headt">
                    <td width="200px">Teléfono </td>
                    <td> <span ></span> <label for="" id="tele"></label> </td>
                    
                </tr>
                <tr class="headt">
                    <td width="200px">Correo</td>
                    <td> <label for="" id="corre"></label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Numero de DUI </td>
                    <td> <label for="" id="dui"></label> </td>
                </tr>
                <tr tr class="headt">
                    <td width="200px">Numero de NIT </td>
                    <td><label for="" id="iva"></label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Tipo de Contrato</td>
                    <td> <span ></span> <label for="" id="alta"></label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Agencia</td>
                    <td> <span ></span> <label for="" id="baja"></label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Nº de ISSS</td>
                    <td> <span ></span> <label for="" id="tipo"></label> </td>
                </tr>
                
                <tr class="headt">
                    <td width="200px">Nº de AFP</td>
                    <td> <label for="" id="estado"></label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Cargo</td>
                    <td> <label for="" id="agenci"></label> </td>
                </tr>
                <tr class="headt">
                    <td width="230px">Fecha de Alta</td>
                    <td> <label for="" id="titul"></label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Salario</td>
                    <td> <label for="" id="banco"></label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Fecha de Baja</td>
                    <td> <label for="" id="cuenta"></label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Nota </td>
                    <td> <label for="" id="tcuenta"></label> </td>
                </tr>

                <tr class="headt">
                    <br>
                    <td  colspan="3" class="pt-2"> <h4> Datos del vehiculo</h4>
                        <hr>
                    </td>
                      
                </tr>
                <tr class="headt">
                    <td width="200px">Tipo de Vehiculo </td>
                    <td> <label for="" id="chivo"></label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Equipo es asignado </td>
                    <td> <label for="" id="tmoney"></label> </td>
                </tr>
                
                <tr class="headt">
                    <td width="200px">Numero de placa</td>
                    <td> <label for="" id="empresa"></label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Numero de tarjeta</td>
                    <td> <label for="" id="giro"></label> </td>
                </tr>
               
                <tr class="headt">
                    <td width="200px">Numero de licencia </td>
                    <td> <label for="" id="nrc"></label> </td>
                </tr>


            </table>


        </div>



       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times" style="color: #ffffff;"></i> &nbsp; Cerrar</button>
        <a id="impri" class="btn btn-primary" style="color: #ffffff;">Imprimir</a>
      </div>
    </div>
  </div>
</div>


<!-- Termina Modal -->





<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://kit.fontawesome.com/b64093b700.js" crossorigin="anonymous"></script> 




<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" defer></script>

    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js" defer></script>

                 
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" defer></script>

<!--
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js" defer></script>

<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js" ></script>








<script src="https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"></script>
<script>



</script>

-->

<script>
    
  
$(document).ready(function(){
	$(document).on('click', '.edit', function(){
		var id=$(this).val();
		var first=$('#nombre'+id).text();
        var direc=$('#dire'+id).text();
        var telef=$('#tele'+id).text();
        var email=$('#correo'+id).text();
        var du=$('#dui'+id).text();
        var ni=$('#nit'+id).text();
        var alt=$('#tipoc'+id).text();
        var baj=$('#agencia'+id).text();
        var tip=$('#isss'+id).text();
        var esta=$('#afp'+id).text();
        var agenc=$('#cargo'+id).text();
        var titu=$('#falta'+id).text();
        var banc=$('#sala'+id).text();
        var cuent=$('#fbaja'+id).text();
        var tcuent=$('#nota'+id).text();
        var chiv=$('#tvehi'+id).text();
        var tmon=$('#equipo'+id).text();
        var empre=$('#placa'+id).text();
        var gir=$('#tarjeta'+id).text();

        var nr=$('#licencia'+id).text();
        //foti= '/imgs/fotos/';
        var fot=$('#foto'+id).text();
		
	
		$('#edit').modal('show');
		$('#efirstname').text(first);
        $('#dire').text(direc);
        $('#tele').text(telef);
        $('#corre').text(email);
        $('#dui').text(du);
        $('#iva').text(ni);
        $('#alta').text(alt);
        $('#baja').text(baj);
        $('#tipo').text(tip);
        $('#estado').text(esta);  
        $('#agenci').text(agenc);
        $('#titul').text(titu);
        $('#banco').text(banc);
        $('#cuenta').text(cuent);
        $('#tcuenta').text(tcuent);
        $('#chivo').text(chiv);
        $('#tmoney').text(tmon);
        $('#empresa').text(empre);
        $('#giro').text(gir);   
 
        $('#nrc').text(nr);
        //$('#fotos').src(fot);
        var ide = '/repartidor/imprimir/'+id ;
		$('#fotos').attr("src", fot);
        //$('#impri a').prop("href", ide);
        //$('.paginacion a').prop('href','http://nuevaUrl.com');
        document.getElementById("impri").href = ide;
	});
});
       

$(document).ready(function() {

  $('#trepartidor').DataTable( {
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

                            
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>    
@endsection

