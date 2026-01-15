
@extends('layouts.app')

@section('content')
<script languague="javascript">
       

        function mostrando()
{
  var checkbox = document.getElementById('check2');
  if (checkbox.checked != true)
  {
    div = document.getElementById('flotante');
            div.style.display = 'none';
           

  }else{
    div = document.getElementById('flotante');
            div.style.display = '';
           
  }
}


function mostrando2()
{
  var checkbox = document.getElementById('check3');
  if (checkbox.checked != true)
  {
    div = document.getElementById('flotante2');
            div.style.display = 'none';
           

  }else{
    div = document.getElementById('flotante2');
            div.style.display = '';
           
  }
}

</script>
<script>
    function redireccionarPagina(){
    window.setTimeout( abrirURL, 2000 ); // 3 segundos
};
    
function abrirURL(){
    //Abrir URL que necesites
    //window.location = "http://127.0.0.1:8000/estatus/";
    window.location = "https://appmeloexpress.com/estatus/";
};
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
                            
<style>
    @media print{
@page {
size: landscape;
}
} 
    /*
    .dropdown-menu-center {
  left: 2% !important;
  right: auto !important;
  text-align: center !important;
  transform: translate(-50%, 0) !important;
        margin-top: 25px;
}
*/
.opciones li {
    margin-right: 45px;
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
.opciones a:link, a:visited, a:active {
            text-decoration:none;
            color: black;
        }
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
.pagina3{
    margin-bottom: 0px;
    margin-top: 0px;
    
}
.dataTables_paginate a:hover {
    color: white !important;
    background:#0d6efd !important;
    
}
 
input[type="date"]::-webkit-calendar-picker-indicator {
        display: block;
        background: transparent;
        bottom: 0;
        color: transparent;
        cursor: pointer;
        height: auto;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        width: auto;
    }

    input[type="date"]::before {
	color: #999999;
	content: attr(placeholder) !important;
}
input[type="date"] {
	color: #ffffff;
    
}
input[type="date"]:focus,
input[type="date"]:valid {
	color: #666666;
    
}
input[type="date"]:focus::before,
input[type="date"]:valid::before {
	content: "" !important;
}

.dt-buttons button {
    background: #0275d8;
    color: white;
    border-radius: 5px;
    font-size: 16px;
    float: right;
}
.imprimir{
    float: right;
    margin-top: -70px;
    margin-right: -200px;
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
<br>
 
<div class="row" style="background-color: white;" >
    <div class="  col-sm-12 py-3" >
        <h3 class="text-center">Cambiar status</h3>
    </div>
            
          
    
 
    <div class="col-12">
 
         


            <div class="d-flex justify-content-end">
    <span style="font-size:18px; color: red;"> {{ $nota }} &nbsp; </span>
            <div >

            <form action="/pedido/listaestatus" method="get">
                <input type="text" name="codigo" required>
            <button type="submit" class="btn btn-primary">Agregar</button>

</form>
<br>
            </div>
   

  
            </div>




<div class="table-responsive">



<br>
<table id="tpedido2" class="table table-striped mt-2">
<thead style="background-color:#6777ef;">
        
        <th style="color: #fff;">ID</th>
        <th style="color: #fff;">Comercio</th>
        <th style="color: #fff;">Destinatario</th>
        <th style="color: #fff;">Direccion</th>
        
        <th style="color: #fff;">Tipo</th>
        <th style="color: #fff;">Estado del envio</th>
        <th style="color: #fff;">Fecha de entrega</th>
        <th style="color: #fff;">Agencia</th>
        <th style="color: #fff;">Repartidor</th>
        <th style="color: #fff;">Ruta</th>
        <th style="color: #fff;">Nota</th>
        <th style="color: #fff;">Opciones</th>
    </tr>
</thead>
<tbody>
    
    @foreach($pedidos as $pedido)
    <tr >
    <td style="font-weight: bolder; color: #484f55;">{{ $pedido->id }}</td>
    <td style="font-weight: bolder; color: #484f55;">{{ $pedido->vendedor }}</td>
    <td style="font-weight: bolder; color: #484f55;">{{ $pedido->destinatario }}</td>
    <td>{{ $pedido->direccion }}</td>
    <td>{{ $pedido->tipo }}</td>
    <td style="background: #e3e8e7"> <h5><span class="badge badge-dark">{{ $pedido->estado }}</span></h5></td>
    <td> {{ date('d/m/Y', strtotime($pedido->fecha_entrega)) }}</td>
    <td> {{ $pedido->agencia }}</td>
    <td> {{ $pedido->repartidor }}</td>
    <td> {{ $pedido->ruta }}</td>
    <td> {{ $pedido->nota }}</td>
    <span hidden id="nom{{ $pedido->id }}"> {{ $pedido->vendedor }}</span>
    <span hidden id="des{{ $pedido->id }}"> {{ $pedido->destinatario }}</span>
    <span hidden id="tel{{ $pedido->id }}"> {{ $pedido->telefono }}</span>
    <span hidden id="dir{{ $pedido->id }}"> {{ $pedido->direccion}}</span>
    <span hidden id="fec{{ $pedido->id }}"> {{  date('d/m/Y', strtotime($pedido->created_at))  }}</span>
    <span hidden id="fece{{ $pedido->id }}"> {{  date('d/m/Y', strtotime($pedido->fecha_entrega))}}</span>
    <span hidden id="tip{{ $pedido->id }}"> {{ $pedido->tipo}}</span>
    <span hidden id="este{{ $pedido->id }}"> {{ $pedido->estado}}</span>
    <span hidden id="estp{{ $pedido->id }}"> {{ $pedido->pagado}}</span>
    <span hidden id="pre{{ $pedido->id }}"> {{ $pedido->precio}}</span>
    <span hidden id="env{{ $pedido->id }}"> {{ $pedido->envio}}</span>
    <span hidden id="tot{{ $pedido->id }}"> {{ $pedido->total}}</span>
    <span hidden id="ing{{ $pedido->id }}"> {{ $pedido->ingresado}}</span>
    <span hidden id="ang{{ $pedido->id }}"> {{ $pedido->agencia}}</span>
    <span hidden id="rep{{ $pedido->id }}"> {{ $pedido->repartidor}}</span>
    <span hidden id="rut{{ $pedido->id }}"> {{ $pedido->ruta}}</span>
    <span hidden id="not{{ $pedido->id }}"> {{ $pedido->nota}}</span>
    <span hidden id="fot{{ $pedido->id }}"> /imgs/fotos/{{ $pedido->foto}}</span>
    <span hidden id="fot2{{ $pedido->id }}"> /imgs/fotos/{{ $pedido->foto2}}</span>
    <span hidden id="fot3{{ $pedido->id }}"> /imgs/fotos/{{ $pedido->foto3}}</span>

    <td class="opciones text-center" style="">
    
  
  
 
    <a href="" class="dropdown-toggle" data-toggle="dropdown">

    <i class="fas fa-list"></i></a>
    <ul class="dropdown-menu" style="background-color: #ffffff;"> 
     <div class="botones"> 
     @can('crear-rol')
    <li class="botones">
    &nbsp;
    <i class="fas fa-edit"></i>
    &nbsp;&nbsp;
    <a href="/pedidos/{{ $pedido->id }}/edit" ><button style="background: none; border: 0;">Editar</button></a></li> 
    @endcan
    </div>  
	<li class="botones">
   
    &nbsp;
    <i class="fas fa-eye"></i>
    &nbsp;&nbsp;
    <button type="button" class="edit" data-toggle="modal" value="{{ $pedido->id }}" data-target="#exampleModal" style="background: none; border: 0;">Ver</button>
</form>
</li>

<div class="botones"> 
    <li class="botones">
    &nbsp;
    <i class="fas fa-edit"></i>
    &nbsp;&nbsp;
    <a href="/pedidos/etiqueta/{{ $pedido->id }}" ><button style="background: none; border: 0;">Etiqueta</button></a></li> 
    </div>  

    @can('crear-rol')
<li class="botones">
    <form action="{{ route ('pedidos.destroy', $pedido->id)}}" method="POST">
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
    @endforeach
  
</tbody> 
</table>
<tr>
        <td colspan="12" style="width:100%">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal5" style="float:right;">
  Cambiar Estado en Lote
</button>
        </td>
    </tr>

<!-- Modal estatus en lote-->
<form action="/pedido/cambiando" method="get">
<div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar Estado en Lote</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <select id="estado" name="estado" class="form-control" tabindex="9" onChange="jsFunction()" id="estado">
            <option value="Creado" onclick="jsFunction()">Creado</option>
            <option value="En ruta">En ruta</option>
            <option value="Entregado">Entregado</option>
            <option value="Nr devuelto al comercio">Nr devuelto al comercio</option>
            <option value="Reprogramado">Reprogramado</option>
            <option value="Agencia San Salvador">Agencia San Salvador</option>
            <option value="Agencia San Miguel">Agencia San Miguel</option>
            <option value="Agencia Santa Ana">Agencia Santa Ana</option>
            <option value="No retirado agencia San Salvador">No retirado agencia San Salvador</option>
            <option value="No retirado agencia San Miguel">No retirado agencia San Miguel</option>
            <option value="No retirado agencia Santa Ana">No retirado agencia Santa Ana</option>
            <option value="No retirado Centro logístico">No retirado Centro logístico</option>
            <option value="Casillero San Salvador">Casillero San Salvador</option>
            <option value="Casillero San Miguel">Casillero San Miguel</option>
            <option value="Casillero Santa Ana">Casillero Santa Ana</option>
            
          </select>

          <br>
        

 <label hidden for="" id="prueba" name="prueba"></label> 
 <input hidden type="text" id="proba" name="proba">

 <div class="col-12">
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="check2" name="check2" Onclick="javascript:mostrando();">
            <label class="form-check-label" for="check2">Asignar repartidor</label>
        </div>
</div>


<div class="col-6" id="flotante" style="display:none;">

    <div class="input-group ">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"> <i class="fas fa-truck"></i> </span>
        </div>

        <select id="repartidor" name="repartidor" class="form-control" tabindex="15">
            <option value="">-Sin asignar-</option>
            @foreach($repartidores as $repartidor)
            <option value="{{ $repartidor->nombre }}">{{ $repartidor->nombre }}</option>
            @endforeach
          </select>

    </div>

</div>







<div class="col-12">
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="check3" name="check3" Onclick="javascript:mostrando2();">
            <label class="form-check-label" for="check3">Caja o Estante</label>
        </div>
</div>


<div class="col-6" id="flotante2" style="display:none;">

    <div class="input-group ">
        <div class="input-group-prepend">
            
        </div>

        <input type="text" id="estante" name="estante">

    </div>

</div>






      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <button type="submit" name="impri" class="btn btn-primary" formtarget="_blank" onclick="redireccionarPagina()">Actualizar e Imprimir</button>
        </form>
      </div>
    </div>
  </div>
</div>

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
                    <td  colspan="3"><h4>Datos del Comercio</h4>
                        <hr>
                    </td>
                    
                </tr>

                <tr class="headt">
                    <td width="230px">Nombre de comercio / Tienda </td>
                    <td> <span ></span> <label for="" id="nombre"></label> </td>
                    <td rowspan="15"><span ></span> <label for="" > </label> <img alt="" class=" img-thumbnail" id="fotos" width="250"> 
                    <br> <img alt="" id="fotos2" width="250">
                    <br> <img alt="" id="fotos3" width="250"></td>
                </tr>

                <tr class="headt">
                    <td width="230px">Dirección </td>
                    <td> <span ></span> <label for="" id="dire"></label> </td>
                    
                </tr>
                

                <tr class="headt">
                    <br>
                    <td  colspan="3" class="pt-2"> <h4> Datos del destinatario</h4>
                        <hr>
                    </td>
                      
                </tr>

                <tr class="headt">
                    <td width="230px">Destinatario </td>
                    <td> <span ></span> <label for="" id="desti"></label> </td>
                    
                </tr>
                <tr class="headt">
                    <td width="230px">Telefono </td>
                    <td> <span ></span> <label for="" id="telef"></label> </td>
                    
                </tr>
                <tr class="headt">
                    <td width="230px">Direccion de entrega </td>
                    <td> <span ></span> <label for="" id="direc"></label> </td>
                    
                </tr>
                

                <tr class="headt">
                    <br>
                    <td  colspan="3" class="pt-2"> <h4> Datos del paquete</h4>
                        <hr>
                    </td>
                      
                </tr>
 
                <tr class="headt">
                    <td width="230px">Fecha de creacion </td>
                    <td> <span ></span> <label for="" id="fecha"></label> </td>  
                </tr>
                <tr class="headt">
                    <td width="230px">Fecha de entrega </td>
                    <td> <span ></span> <label for="" id="fechen"></label> </td>  
                </tr>
                <tr class="headt">
                    <td width="230px">Tipo de envio </td>
                    <td> <span ></span> <label for="" id="tipoe"></label> </td>  
                </tr>
                </tr>
                <tr class="headt">
                    <td width="230px">Estado del envio </td>
                    <td> <span ></span> <label for="" id="este"></label> </td>  
                </tr>
                <tr class="headt">
                    <td width="230px">Estado del pago </td>
                    <td> <span ></span> <label for="" id="estp"></label> </td>  
                </tr>
                <tr class="headt">
                    <td width="230px">Precio del paquete </td>
                    <td> <span ></span> <label for="" id="preci"></label> </td>  
                </tr>
                <tr class="headt">
                    <td width="230px">Costo del envio </td>
                    <td> <span ></span> <label for="" id="envio"></label> </td>  
                </tr>
                <tr class="headt">
                    <td width="230px">Total a cobrar </td>
                    <td> <span ></span> <label for="" id="total"></label> </td>  
                </tr>

                <tr class="headt">
                    <br>
                    <td  colspan="3" class="pt-2"> <h4> Datos internos</h4>
                        <hr>
                    </td>
                      
                </tr>

                <tr class="headt">
                    <td width="230px">Usuario que registró </td>
                    <td> <span ></span> <label for="" id="ingre"></label> </td>  
                </tr>
                <tr class="headt">
                    <td width="230px">Recepción agencia </td>
                    <td> <span ></span> <label for="" id="agen"></label> </td>  
                </tr>
                <tr class="headt">
                    <td width="230px">Repartidor </td>
                    <td> <span ></span> <label for="" id="repar"></label> </td>  
                </tr>
                <tr class="headt">
                    <td width="230px">Ruta </td>
                    <td> <span ></span> <label for="" id="ruta1"></label> </td>  
                </tr>
                <tr class="headt">
                    <td width="230px">Nota </td>
                    <td> <span ></span> <label for="" id="nota1"></label> </td>  
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








</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>




	
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />


    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" defer></script>

    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js" defer></script>

                 
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" defer></script>

    
    
                 

    <!--
 <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js" defer></script>
-->

 

<script>
       
        
$(document).ready(function(){
	$(document).on('click', '.edit', function(){
		var id=$(this).val();
		var nomb=$('#nom'+id).text();
        var dest=$('#des'+id).text();
        var tele=$('#tel'+id).text();
        var dire=$('#dir'+id).text();
        var fech=$('#fec'+id).text();
        var feche=$('#fece'+id).text();
        var tipo=$('#tip'+id).text();
        var est=$('#este'+id).text();
        var esp=$('#estp'+id).text();
        var prec=$('#pre'+id).text();
        var envi=$('#env'+id).text();
        var tota=$('#tot'+id).text();
        var ingr=$('#ing'+id).text();
        var ange=$('#ang'+id).text();
        var repa=$('#rep'+id).text();
        var ruta=$('#rut'+id).text();
        var nota=$('#not'+id).text();
        var foto=$('#fot'+id).text();
        var foto2=$('#fot2'+id).text();
        var foto3=$('#fot3'+id).text();
        //foti= '/imgs/fotos/';

		
	
		$('#edit').modal('show');
		$('#nombre').text(nomb);
        $('#desti').text(dest);
        $('#telef').text(tele);
        $('#direc').text(dire);
        $('#fecha').text(fech);
        $('#fechen').text(feche);
        $('#tipoe').text(tipo);
        $('#este').text(est);
        $('#estp').text(esp);
        $('#preci').text(prec);  
        $('#envio').text(envi);
        $('#total').text(tota);
        $('#ingre').text(ingr);
        $('#agen').text(ange);
        $('#repar').text(repa);
        $('#ruta1').text(ruta);
        $('#nota1').text(nota);

        $('#empresa').text(empre);
        $('#giro').text(gir);   
 
        $('#nrc').text(nr);
        //$('#fotos').src(fot);
        var ide = '/repartidor/imprimir/'+id ;
		$('#fotos').attr("src", foto);
        $('#fotos2').attr("src", foto2);
        $('#fotos3').attr("src", foto3);

        //$('#impri a').prop("href", ide);
        //$('.paginacion a').prop('href','http://nuevaUrl.com');

        document.getElementById("impri").href = ide;
	});
});
 






    </script>

    <script>
         
        $(document).ready(function () {
    $('#tpedido2').DataTable(
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

        dom: '<"cambiar" f><"pagina2" p><"cambiar2"l>tri<"pagina1" p>',
        
        
       
       

        } 
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
