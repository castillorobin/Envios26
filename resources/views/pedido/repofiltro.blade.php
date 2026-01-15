
@extends('layouts.app')

@section('content')
<span hidden>
{{ $nor = 0}}
{{ $nretito = 0}}
</span>
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>  
jQuery(document).ready(function($){
    $(document).ready(function() {
       $('.mi-selector').select2({
        placeholder: "Estado"
       });

       $('.mi-selector1').select2({
        placeholder: "Repartidor"
       });
       
      

    });
   
   
});



</script>


<script>
    /*
    function redireccionarPagina(){
    window.setTimeout( abrirURL, 2000 ); // 3 segundos
};
    
function abrirURL(){
    //Abrir URL que necesites
    //window.location = "http://127.0.0.1:8000/reportes";
    window.location = "https://appmeloexpress.com/reportes/";
};
*/
</script>
    <section class="section">
        <div class="section-header">
        <div style="width:100%; ">
            <div style="float:left; width:70%;">
                <h3 class="page__heading">Melo Express</h3>
            </div>
            
        </div>
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
    .botonexcel {
        margin-left: 20px;
        
   float: left;
   
   }
   .dt-buttons button {
    background-color: #ffc107 !important; 
   
     
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
    <div class="  col-sm-12 py-1" >
        
    </div>
            
          
    
 
    <div class="col-12">
 
        

    <form action="/repofiltro" method="get">
            <div class="">
                <table>
                    <tr>
                        <td style="width:400px;">
                        <div class="col-sm-12 ">
       
        <div class="input-group ">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1" style="width:55px;"> <i class="far fa-calendar-alt"></i> </span>
          </div>
          <input type="date" id="fecha" name="fecha" class="form-control" placeholder="Fecha" value="" min="1997-01-01" max="2030-12-31">
          <br>
        
           
        </div>
      </div>
                        </td>
                        <td> 
                             <!-- estado del envio -->
    <div class="col-12">
      
        <div class="input-group">

          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/deliver-food.png"/></span>
          </div>
          <select id="estado" name="estado[]" class="form-control mi-selector" multiple="multiple">
            <option value="estado" >Estado del Envio</option>
            <option value="Creado" >Creado</option>
            <option value="En ruta">En ruta</option>
            <option value="Entregado">Entregado</option>
            <option value="Nr devuelto al comercio">Nr devuelto al comercio</option>
            <option value="Reprogramado">Reprogramado</option>
            <option value="Agencia San Salvador">Agencia San Salvador</option>
            <option value="Agencia San Miguel">Agencia San Miguel</option>
            <option value="Agencia Santa Ana">Agencia Santa Ana</option>
            <option value="No retirado">No retirado</option>
            <option value="No retirado agencia San Salvador">No retirado agencia San Salvador</option>
            <option value="No retirado agencia San Miguel">No retirado agencia San Miguel</option>
            <option value="No retirado agencia Santa Ana">No retirado agencia Santa Ana</option>
            <option value="No retirado Centro logístico">No retirado Centro logístico</option>
            <option value="Casillero San Salvador">Casillero San Salvador</option>
            <option value="Casillero San Miguel">Casillero San Miguel</option>
            <option value="Casillero Santa Ana">Casillero Santa Ana</option>
          </select>
           
        </div>
    </div>
                        </td>
                        <td>
                             <!-- Ruta -->
    <div class="col-sm-12">
       
        <div class="input-group">

          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"> <img src="https://img.icons8.com/external-wanicon-lineal-wanicon/25/null/external-map-logistics-wanicon-lineal-wanicon.png"/></span>
          </div>
          <select id="ruta" name="ruta" class="form-control" tabindex="16"> 
          <option value="ruta">Ruta</option>
          <option value="Ruta 1">Ruta 1</option>
            <option value="Ruta 2">Ruta 2</option>
            <option value="Ruta 3">Ruta 3</option>
            <option value="Ruta 4">Ruta 4</option>
            <option value="Ruta 5">Ruta 5</option>
          </select>
           
        </div>
    </div>
                        </td>
                        <td>
   
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <br>
                                                     <!-- Tipo -->
    <div class="col-12">
        
        <div class="input-group">

          <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/external-kiranshastry-solid-kiranshastry/25/null/external-delivery-logistic-delivery-kiranshastry-solid-kiranshastry.png"/></span>
          </div>
          <select id="tipo" name="tipo" class="form-control" tabindex="7">
          <option value="tipo">Tipo de envio</option>
            <option value="Personalizado">Personalizado</option>
            <option value="Personalizado departamental">Personalizado departamental</option>
            <option value="Punto fijo">Punto fijo</option>
            <option value="Casillero departamental">Casillero departamental</option>
            <option value="Casillero San Salvador">Casillero San Salvador</option>
            <option value="Casillero San Miguel">Casillero San Miguel</option>
            <option value="Casillero Santa Ana">Casillero Santa Ana</option>
            <option value="Casillero centro logístico">Casillero centro logístico</option>
          </select>
          
        </div>
    </div>  
                        </td>
                        <td>
                            <br>
                            <!-- Repartidor -->
  
    
    <div class="col-sm-12 ">
        
        <div class="input-group">

          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/external-kmg-design-detailed-outline-kmg-design/25/null/external-delivery-man-logistics-delivery-kmg-design-detailed-outline-kmg-design-2.png"/></span>
          </div>
          <select id="repartidor" name="repartidor[]" class="form-control mi-selector1" multiple="multiple">
            <option value="repartidor">Repartidor</option>
            @foreach($repartidores as $repartidor)
            <option value="{{ $repartidor->nombre }}">{{ $repartidor->nombre }}</option>
            @endforeach
          </select>
           
        </div>
    </div>
                        </td>
                        <td>
                            <br>
                            <!-- Total -->
    <div class="col-sm-12 ">
        
        <div class="input-group ">
          <div class="input-group-prepend" >
            <span class="input-group-text" id="basic-addon1" style="width:55px;"> <i class="fas fa-dollar-sign" style="width:25px;"></i> </span>
          </div>
          <input type="text" id="total" name="total" class="form-control" placeholder="Total" aria-describedby="basic-addon1" >
          
        </div>
    </div>
                        </td>
                        <td>
                            <br>
                        <button type="submit" class="btn btn-primary " style="width:45px; height:40px; border-radius: 5px;" > <i class="fas fa-search"></i></button>      
        <a href="/reportes" class="btn btn-danger " style="width:45px; height:40px; border-radius: 5px;" > <i class="fas fa-times" style="color: #ffffff;"></i></a>
                        </td>
                    </tr>
                    <tr>
</form>

                        <td colspan="3">
                            <br>
                    
                        </td>
                    </tr>
                </table>
            <div >


<br>
            </div>
   

  
            </div>
           

            <form action="/printfiltro/{{$filtro}}/{{$ftipo}}" method="get">

<div class="table-responsive">



<br>
<table id="tpedido" class="table table-striped mt-2">
<thead style="background-color:#6777ef;">
        
        <th style="color: #fff;" hidden >ch</th>
        <th style="color: #fff;">ID</th>
        <th style="color: #fff;">Comercio</th>
        <th style="color: #fff;">Destinatario</th>
        <th style="color: #fff;">Direccion</th>
        
        <th style="color: #fff;">Tipo</th>
        <th style="color: #fff;">Estado del envio</th>
        <th style="color: #fff;">Fecha de entrega</th>
        <th style="color: #fff;">Precio</th>
        <th style="color: #fff;">Envio</th>
        <th style="color: #fff;">Total</th>
        
        <th style="color: #fff;">Opciones</th>
    </tr>
</thead>
<tbody>
<!--
{{$cobrado = 0  }}
        {{ $total = 0}}
            {{  $tenvi = 0}}
-->

    @for ($i=0; $i< count($pedidos); $i++)
    <tr >
        <td hidden ><input type="checkbox" value="{{ $pedidos[$i]->id }}" class="form-check-input" id="check3" name="checked[]" checked></td>
    <td style="font-weight: bolder; color: #484f55;">{{ $pedidos[$i]->id }}</td>
    <td style="font-weight: bolder; color: #484f55;">{{ $pedidos[$i]->vendedor }}</td>
    <td style="font-weight: bolder; color: #484f55;">{{ $pedidos[$i]->destinatario }}</td>
    <td>{{ $pedidos[$i]->direccion }}</td>
    <td>{{ $pedidos[$i]->tipo }}</td>
    <td style="background: #e3e8e7"> <h5><span class="badge badge-dark">{{ $pedidos[$i]->estado }}</span></h5></td>
    <td> {{ date('d/m/Y', strtotime($pedidos[$i]->fecha_entrega)) }}</td>
    <td> ${{ $pedidos[$i]->precio }}</td>
    <td>${{ $pedidos[$i]->envio }}</td>
    <td> ${{ $pedidos[$i]->total }}</td>
    
   

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
    <a href="/pedidos/{{ $pedidos[$i]->id }}/edit" ><span style="background: none; border: 0;">Editar</span></a></li> 
    @endcan
    </div>  
	<li class="botones">
   
    &nbsp;
    <i class="fas fa-eye"></i>
    &nbsp;&nbsp;
    <button type="button" class="edit" data-toggle="modal" value="{{ $pedidos[$i]->id }}" data-target="#exampleModal" style="background: none; border: 0;">Ver</button>
</form>
</li>

<div class="botones"> 
    <li class="botones">
    &nbsp;
    <i class="fas fa-edit"></i>
    &nbsp;&nbsp;
    <a href="/pedidos/etiqueta/{{ $pedidos[$i]->id }}" ><button style="background: none; border: 0;">Etiqueta</button></a></li> 
    </div>  
 


    </ul>
 
 

    </td>
    </tr>
    
   
    @if ($pedidos[$i]->estado == 'No retirado')
<span hidden>
{{ $nor++}}
{{ $nretito = $nretito + $pedidos[$i]->precio}}
</span>
@endif
            



    @endfor

    
    
    
</tbody>
</table>
<br>


<!-- Inicio Modal 

-->

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


<!-- Termina Modal 



foreach($pedidos as $suma){
            $cobrado = $cobrado + $suma->precio;
            $total = $total + $suma->total;
            $tenvi = $tenvi + $suma->envio;
            $cant = $cant + 1;
        }

-->


</div>
</div>
</div>
{{date_default_timezone_set('America/El_Salvador') }}

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
    $('#tpedido').DataTable(

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
    dom: '<"cambiar" f> <"botonexcel" B><"pagina2" p><"cambiar2"l>tri<"pagina1" p>',
            buttons: [
                {
                extend: 'excel',
                title: 'Melo Express - Reporte diario',
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ],
                    page: 'all',
                   
                }
            },
            
            [
                {
                extend: 'pdfHtml5',
                  messageTop: 'Operario: {{\Illuminate\Support\Facades\Auth::user()->name}} \n Repartidor: {{ $pedidos[0]->repartidor}} \n Fecha: {{ now()->Format('d/m/Y')}} Hora: {{ date("H:i:s")}} \n Ruta: {{ $pedidos[0]->ruta}} \n Cantidad: {{ count($pedidos)}} \n No retirados: {{ $nor++}}',
                  title: 'Melo Express - Reporte diario',
                  orientation: 'landscape',
                  "messageBottom": '\n Total cobrado: ${{ $cobrado = $pedidos->sum('precio') }} \n Total sin envio: ${{ $cobrado = $pedidos->sum('total') }} \n Total de envio: ${{ $cobrado = $pedidos->sum('envio') }} \n \n Total: ${{ $cobrado = $pedidos->sum('precio') }} \n Total no retirado: ${{ $nretito }} \n Total a cobrar: ${{ $cobrado - $nretito }}',
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ],
                    
                }
            
                
              }
                    
              
              
              ],
            ]
 
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
