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
   
.cambiar {
   
    float: left;
      
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
.nocolor a:link, a:visited, a:active {
    text-decoration:none; 
    color:black;
            
        }

.dataTables_paginate a:hover {
    color: white !important;
    background:#0d6efd !important;
    
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
    window.location = "https://appmeloexpress.com/comercio/filtrado/" + data.text; 
    //window.location = "http://127.0.0.1:8000/comercio/filtrado/" + data.text;
        });

    });
   
   
});



</script>
  


<div class="row" style="background-color: white;" >
<!--
<h8 style="font-size:14px" ><i class="fas fa-home"></i> Inicio / Almacen / Recolectas</h8>
-->
    <div class="  col-sm-12 py-3" >
        <h3 class="text-center">Listado de Comercios</h3>
    </div>

 
 
<div class="col-12">
<div class="row mt-1 mr-1">   
    <div class="input-group mb-3 col-6">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"> <i class="fas fa-search"></i> </span>
        </div>

        <select class="form-control mi-selector" name="comer" id="comer">
            <option value="">Buscar Comercio</option>
            @for($i=0;  $i< count($vendedorestotal); $i++ )
            <option value="{{$vendedorestotal[$i]->nombre}}">{{ $vendedorestotal[$i]->nombre }} </option>
            @endfor
        </select>

    </div>
    
    <div class="d-flex justify-content-end col-6">
            @can('crear-comercios')
        <div >               
            <a href="/vendedores/create" class="btn btn-warning" style="color:white;"><i class="fas fa-database"></i> Agregar Comercio</a>
            <br>
        </div>
            @endcan
     </div>
     </div>






<div class="col-12 table-responsive" >
<br>
    <table id="tvendedores" class="table table-striped mt-2">
        <thead style="background-color:#6777ef;">
    <tr >
        
        <th style="color: #fff;">Comercio</th>
        <th style="color: #fff;">Direccion</th>
        <th style="color: #fff;">Teléfono</th>
        <th style="color: #fff;">Whatsapp</th>
        <th style="color: #fff;">Tipo de comercio</th>
        <th style="color: #fff;">Estado del comercio</th>
        <th style="color: #fff;">Fecha de alta</th>
        
        <th style="color: #fff;">Agencia</th>
        <th style="color: #fff;">Nota</th>
        <th style="color: #fff;">Opciones</th>
    </tr>
        </thead>
    <tbody>
    @for ($i=0; $i< count($vendedores); $i++)
    <tr>
    
    <td><span id="firstname{{ $vendedores[$i]->id }}">{{ $vendedores[$i]->nombre }} </span></td>
    <td><span id="dire{{ $vendedores[$i]->id }}">{{ $vendedores[$i]->direccion }}</span></td>
    <td><span id="tele{{ $vendedores[$i]->id }}">{{ $vendedores[$i]->telefono }}</span></td>
    <td><span id="what{{ $vendedores[$i]->id }}">{{ $vendedores[$i]->whatsapp }}</span></td>
    <td><span id="tipo{{ $vendedores[$i]->id }}">{{ $vendedores[$i]->tipovende }}</span></td>
    <td class="text-center"><span id="estado{{ $vendedores[$i]->id }}"> <h5><span class="badge badge-dark">{{ $vendedores[$i]->estado }}</span></h5></span></td>
    <td><span id="alta{{ $vendedores[$i]->id }}">{{  date("d/m/Y", strtotime($vendedores[$i]->falta))  }} </span></td>
    <span hidden id="baja{{ $vendedores[$i]->id }}">{{  date("d/m/Y", strtotime($vendedores[$i]->fbaja))  }}</span>
    <td><span id="agen{{ $vendedores[$i]->id }}">{{ $vendedores[$i]->agencia }}</span></td>
    <td><span id="ag">{{ $vendedores[$i]->nota }}</span></td>
     
    <span hidden id="correo{{ $vendedores[$i]->id }}"> {{ $vendedores[$i]->correo }}</span>
    <span hidden id="titular{{ $vendedores[$i]->id }}"> {{ $vendedores[$i]->titular }}</span>
    <span hidden id="banco{{ $vendedores[$i]->id }}"> {{ $vendedores[$i]->banco }}</span>
    <span hidden id="cuenta{{ $vendedores[$i]->id }}"> {{ $vendedores[$i]->cuenta }}</span>
    <span hidden id="tcuenta{{ $vendedores[$i]->id }}"> {{ $vendedores[$i]->tcuenta }}</span>
    <span hidden id="chivo{{ $vendedores[$i]->id }}"> {{ $vendedores[$i]->chivo }}</span>
    <span hidden id="tmoney{{ $vendedores[$i]->id }}"> {{ $vendedores[$i]->tmoney }}</span>
    <span hidden id="empresa{{ $vendedores[$i]->id }}"> {{ $vendedores[$i]->empresa }}</span>
    <span hidden id="giro{{ $vendedores[$i]->id }}"> {{ $vendedores[$i]->giro }}</span>
    <span hidden id="dui{{ $vendedores[$i]->id }}"> {{ $vendedores[$i]->dui }}</span>
    <span hidden id="iva{{ $vendedores[$i]->id }}"> {{ $vendedores[$i]->niva }}</span>
    <span hidden id="nrc{{ $vendedores[$i]->id }}"> {{ $vendedores[$i]->nrc }}</span>



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
    <a href="/vendedores/{{ $vendedores[$i]->id }}/edit" ><button style="background: none; border: 0;">Editar</button></a></li> 
    
    </div>  
	<li class="botones">
    <form >
   
    &nbsp;
    <i class="fas fa-eye"></i>
    &nbsp;&nbsp;
    <button type="button" class="edit" data-toggle="modal" value="{{ $vendedores[$i]->id }}" data-target="#exampleModal" style="background: none; border: 0;">Ver</button>
 
    
    </form>
            </li>
            
        <li class="botones">
    <form action="{{ route ('vendedores.destroy', $vendedores[$i]->id)}}" method="POST">
        @csrf
        @method('DELETE')
        &nbsp;
        <i class="fas fa-trash-alt"></i> 
        &nbsp;&nbsp;
        <button style="background: none; border: 0;">Eliminar</button>
        </form>
        </li>
        
    </ul>
    @endcan
   
        
    </td>
    </tr>
    @endfor
    </tbody>
    </table>
    </div>
   

    </div>





<!-- Inicio Modal -->

<div class="modal fade" id="exampleModal"  aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 999999999;">
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
                    <td  colspan="2"><h4>Informacion del Comercio </h4>
                        <hr>
                    </td>
                    
                </tr>
                <tr class="headt">
                    <td width="230px">Comercio / tienda </td>
                    <td> <span ></span> <label for="" id="efirstname"></label> </td>
                    
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
                    <td width="200px">Whatsapp</td>
                    <td> <span ></span> <label for="" id="what"></label> </td>
                    
                </tr>
                <tr class="headt">
                    <td width="200px">Fecha de Alta</td>
                    <td> <span ></span> <label for="" id="alta"></label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Fecha de Baja</td>
                    <td> <span ></span> <label for="" id="baja"></label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Tipo de Comercio</td>
                    <td> <span ></span> <label for="" id="tipo"></label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Correo</td>
                    <td> <label for="" id="corre"></label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Estado del comercio </td>
                    <td> <label for="" id="estado"></label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Agencia </td>
                    <td> <label for="" id="agenci"></label> </td>
                </tr>

                <tr class="headt">
                    <br>
                    <td  colspan="2" class="pt-2"> <h4> Datos Bancarios</h4>
                        <hr>
                    </td>
                     
                </tr>
                <tr class="headt">
                    <td width="230px">Nombre del titular de la cuenta </td>
                    <td> <label for="" id="titul"></label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Nombre del Banco </td>
                    <td> <label for="" id="banco"></label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Número de cuenta </td>
                    <td> <label for="" id="cuenta"></label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Tipo de cuenta </td>
                    <td> <label for="" id="tcuenta"></label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Numero de Chivo Wallet </td>
                    <td> <label for="" id="chivo"></label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Numero de Tigo Money </td>
                    <td> <label for="" id="tmoney"></label> </td>
                </tr>
                <tr class="headt">
                    <td  colspan="2" class="pt-2"> <h4>Información Fiscal</h4>
                        <hr>
                    </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Nombre de la empresa</td>
                    <td> <label for="" id="empresa"></label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Giro</td>
                    <td> <label for="" id="giro"></label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Numero de DUI </td>
                    <td> <label for="" id="dui"></label> </td>
                </tr>
                <tr tr class="headt">
                    <td width="200px">Numero de IVA </td>
                    <td><label for="" id="iva"></label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Numero de NRC </td>
                    <td> <label for="" id="nrc"></label> </td>
                </tr>


            </table>


        </div>



       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times" style="color: #ffffff;"></i> &nbsp; Cerrar</button>
        <button type="button" class="btn btn-primary"><i class="fas fa-print"></i> &nbsp; Imprimir</button>
      </div>
    </div>
  </div>
</div>


<!-- Termina Modal -->









<script src="https://code.jquery.com/jquery-3.5.1.js"></script>




	
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />


    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" defer></script>

    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js" defer></script>

<script>
       
  
$(document).ready(function(){
	$(document).on('click', '.edit', function(){
		var id=$(this).val();
		var first=$('#firstname'+id).text();
        var direc=$('#dire'+id).text();
        var telef=$('#tele'+id).text();
        var whats=$('#what'+id).text();
        var alt=$('#alta'+id).text();
        var baj=$('#baja'+id).text();
        var tip=$('#tipo'+id).text();
        var email=$('#correo'+id).text();
        var esta=$('#estado'+id).text();
        var agenc=$('#agen'+id).text();
        var titu=$('#titular'+id).text();
        var banc=$('#banco'+id).text();
        var cuent=$('#cuenta'+id).text();
        var tcuent=$('#tcuenta'+id).text();
        var chiv=$('#chivo'+id).text();
        var tmon=$('#tmoney'+id).text();
        var empre=$('#empresa'+id).text();
        var gir=$('#giro'+id).text();
        var du=$('#dui'+id).text();
        var iv=$('#iva'+id).text();
        var nr=$('#nrc'+id).text();
		
	
		$('#edit').modal('show');
		$('#efirstname').text(first);
        $('#dire').text(direc);
        $('#tele').text(telef);
        $('#what').text(whats);
        $('#alta').text(alt);
        $('#baja').text(baj);
        $('#tipo').text(tip);
        $('#corre').text(email);
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
        $('#dui').text(du);
        $('#iva').text(iv);
        $('#nrc').text(nr);
		
	});
});


       $(document).ready(function () {
    $('#tvendedores').DataTable(
        {
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
        
        dom: 'tri',
       

        } /*hasata aqui*/
    );
});





    </script>


                            
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>    
@endsection

