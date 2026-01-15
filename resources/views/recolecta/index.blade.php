@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Recolecta</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card"> 
                        <div class="card-body">
                           
                             
<style>
 
 

.cambiar {
   
    float: left;
    margin - 
     
   }

.cambiar2 {
    float: right;
    margin-right: 20px;
   
 
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
  z-index: 0;
}
</style>



<div class="row" style="background-color: white;" >
<!--
<h8 style="font-size:14px" ><i class="fas fa-home"></i> Inicio / Almacen / Recolectas</h8>
-->
    <div class="  col-sm-12 py-3" >
        <h3 class="text-center">Listado de Recolectas</h3>
    </div>

 
    <div class="col-12">


            <div class="d-flex justify-content-end">
            @can('crear-recolecta')
            <div >
                <a href="/recolecta/create" class="btn btn-warning" style="color:white;"><i class="fas fa-database"></i> Agregar Recolecta</a>
                <br>
            </div>
            @endcan


</div>



   




 


  <div class="table-responsive" >



<table id="tvendedor" class="table table-striped mt-2">
<thead style="background-color:#6777ef;">
    <tr >
        <th style="color: #fff;">Comercio</th>
        <th style="color: #fff;">Dirección de recolecta</th>
        <th style="color: #fff;">Teléfono</th>
        <th style="color: #fff;">Fecha de recolecta</th>
        <th style="color: #fff;">Fecha de entrega</th>
        <th style="color: #fff;" >Estado de recolecta</th>
        <th style="color: #fff;">Agencia</th>
        <th style="color: #fff;">Opciones</th>
    </tr>
</thead>
<tbody> 
   
    @for ($i=0; $i< count($recolectas ); $i++)
    <tr>
    <td>{{ $recolectas[$i]->nombre }}</td>
    <td>{{ $recolectas[$i]->direccion }}</td>
    <td>{{ $recolectas[$i]->telefono }}</td>
    <td>{{  date('d/m/Y', strtotime($recolectas[$i]->created_at))  }} </td>
    <td>{{  date('d/m/Y', strtotime($recolectas[$i]->fechaent))  }}</td>
    <td class="text-center" style="background: #e3e8e7"><h5><span class="badge badge-dark">{{ $recolectas[$i]->estado }}</span></h5></td>
    <td>{{ $recolectas[$i]->agencia }}</td>

    <span hidden id="nom{{ $recolectas[$i]->id }}"> {{ $recolectas[$i]->nombre }}</span>
    <span hidden id="dir{{ $recolectas[$i]->id }}"> {{ $recolectas[$i]->direccion }}</span>
    <span hidden id="tel{{ $recolectas[$i]->id }}"> {{ $recolectas[$i]->telefono }}</span>
    <span hidden id="wha{{ $recolectas[$i]->id }}"> {{ $recolectas[$i]->whatsapp }}</span>
    <span hidden id="fec{{ $recolectas[$i]->id }}"> {{  date('d/m/Y', strtotime($recolectas[$i]->created_at))  }}</span>
    <span hidden id="fece{{ $recolectas[$i]->id }}"> {{  date('d/m/Y', strtotime($recolectas[$i]->fechaent))}}</span>
    <span hidden id="rep{{ $recolectas[$i]->id }}"> {{ $recolectas[$i]->repartidor }}</span>
    <span hidden id="est{{ $recolectas[$i]->id }}"> {{ $recolectas[$i]->estado }}</span>
    <span hidden id="not{{ $recolectas[$i]->id }}"> {{ $recolectas[$i]->nota }}</span>
    <span hidden id="age{{ $recolectas[$i]->id }}"> {{ $recolectas[$i]->agencia }}</span>

    <td class="opciones text-center" style="">
    
   
   
 
    <a href="" class="dropdown-toggle" data-toggle="dropdown">

    <i class="fas fa-list"></i></a>
    <ul class="dropdown-menu" style="background-color: #ffffff;">
    @can('crear-rol')
    <div class="botones"> 
    
    <li class="botones">
    &nbsp;
    
    <i class="fas fa-edit"></i>
    &nbsp;&nbsp;
    <a href="/recolecta/{{ $recolectas[$i]->id }}/edit" ><button style="background: none; border: 0;">Editar</button></a></li> 
    </div>  
    @endcan
	<li class="botones">
    <form >
   
    &nbsp;
    <i class="fas fa-eye"></i>
    &nbsp;&nbsp;
    <button type="button" class="edit" data-toggle="modal" value="{{ $recolectas[$i]->id }}" data-target="#exampleModal" style="background: none; border: 0;">Ver</button>
  
    
    </form>
            </li>
            @can('borrar-recolecta')
        <li class="botones">
    <form action="{{ route ('recolecta.destroy', $recolectas[$i]->id)}}" method="POST">
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





<!-- Inicio Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
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
                    <td  colspan="3"><h4>Datos de Recolecta</h4>
                        <hr>
                    </td>
                    
                </tr>

                <tr class="headt">
                    <td width="230px">Nombre de comercio / Tienda </td>
                    <td> <span ></span> <label for="" id="nombr"></label> </td>
                    <td rowspan="15"><span ></span> <label for="" > </label> <img alt="" class=" img-thumbnail" id="fotos" width="250"> 
                    <br> <img alt="" id="fotos2" width="250">
                    <br> <img alt="" id="fotos3" width="250"></td>
                </tr>

                <tr class="headt">
                    <td width="230px">Dirección </td>
                    <td> <span ></span> <label for="" id="direc"></label> </td>
                    
                </tr>
                <tr class="headt">
                    <td width="230px">Telefono </td>
                    <td> <span ></span> <label for="" id="tele"></label> </td>
                    
                </tr>
                <tr class="headt">
                    <td width="230px">Whatsapp </td>
                    <td> <span ></span> <label for="" id="whats"></label> </td>
                    
                </tr>
                <tr class="headt">
                    <td width="230px">Fecha de recoelcta </td>
                    <td> <span ></span> <label for="" id="feche"></label> </td>
                    
                </tr>
                <tr class="headt">
                    <td width="230px">Fecha de entrega </td>
                    <td> <span ></span> <label for="" id="fecha"></label> </td>
                    
                </tr>
                <tr class="headt">
                    <td width="230px">Repartidor </td>
                    <td> <span ></span> <label for="" id="repar"></label> </td>
                    
                </tr>
                <tr class="headt">
                    <td width="230px">Estado </td>
                    <td> <span ></span> <label for="" id="estad"></label> </td>
                    
                </tr>
                <tr class="headt">
                    <td width="230px">Nota`</td>
                    <td> <span ></span> <label for="" id="notas"></label> </td>
                    
                </tr>
                
                <tr class="headt">
                    <td width="230px">Agencia</td>
                    <td> <span ></span> <label for="" id="agenc"></label> </td>
                    
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

  

                 
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js" defer></script>
 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" defer></script>



<script>
    
  
$(document).ready(function(){
	$(document).on('click', '.edit', function(){
		var id=$(this).val();
		var nomb=$('#nom'+id).text();
        var dire=$('#dir'+id).text();
        var telef=$('#tel'+id).text();
        var what=$('#wha'+id).text();
        var fech=$('#fec'+id).text();     
        var feche=$('#fece'+id).text();
        var repa=$('#rep'+id).text();
        var esta=$('#est'+id).text();
        var nota=$('#not'+id).text();     
        var agen=$('#age'+id).text();     
        
		
	
		$('#edit').modal('show');
		$('#nombr').text(nomb);
        $('#direc').text(dire);
        $('#tele').text(telef);
        $('#whats').text(what);
        $('#feche').text(fech);
        $('#fecha').text(feche);
        $('#repar').text(repa);
        $('#estad').text(esta);
        $('#notas').text(nota);
        $('#agenc').text(agen);
		
	});
});
       

    
    </script>


<script>
    
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


                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>    
@endsection

