
@extends('layouts.app')

@section('content')

<meta charset='utf-8'>
{{date_default_timezone_set('America/El_Salvador') }}
    <section class="section">
        <div class="section-header">
        <div style="width:100%; ">
            <div >
                <h3 class="page__heading">Reporte de Cobros</h3>
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
 
        

    <form action="/reportes/cobrofiltro" method="get">
            <div class="">
                <table>
                    <tr>
                        <td style="width:400px;">
                        <div class="col-sm-12 ">
       
        <div class="input-group ">Desde: &nbsp;  &nbsp;
          <div class="input-group-prepend">
            
            <span class="input-group-text" id="basic-addon1" style="width:55px;"> <i class="far fa-calendar-alt"></i> </span>
          </div>
          <input type="date" id="fecha1" name="desde" class="form-control" placeholder="Fecha" value="" min="1997-01-01" max="2030-12-31">
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
        <select id="estado" name="estado" class="form-control" tabindex="9">
          <option value="estado" >Estado del Envio</option>
          <option value="Creado" >Creado</option>
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
         
      </div>
  </div>
                        </td>
                        <td>
                            
                        </td>
                        <td>
   
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <br>
                                                     <!-- hasta-->
                                                     <div class="col-sm-12 ">
       
       <div class="input-group ">Hasta: &nbsp;  &nbsp;
         <div class="input-group-prepend">
           
           <span class="input-group-text" id="basic-addon1" style="width:55px;"> <i class="far fa-calendar-alt"></i> </span>
         </div>
         <input type="date" id="fecha" name="hasta" class="form-control" placeholder="Fecha" value="" min="1997-01-01" max="2030-12-31">
         <br>
       
           
       </div>
     </div>
                        </td>
                        <td>
                            <br>
                            
                        </td>
                        <td>
                            <br>
              </td>
                        <td>
                            <br>
                        <button type="submit" class="btn btn-primary " style="width:45px; height:40px; border-radius: 5px;" > <i class="fas fa-search"></i></button>      
        <a href="/reportes/ganancia" class="btn btn-danger " style="width:45px; height:40px; border-radius: 5px;" > <i class="fas fa-times" style="color: #ffffff;"></i></a>
                        </td>
                    </tr>
                    <tr>
</form>

                        <td colspan="3">
                            <br>
                     &nbsp; &nbsp; <button type="submit" class="btn btn-warning btn-lg " disabled><i class="fas fa-print" ></i> Imprimir</button>      
                        </td>
                    </tr>
                </table>
            <div >


<br>
            </div>
   

  
            </div>




<div class="table-responsive">



<br>
<table id="tpedido" class="table table-striped mt-2">
<thead style="background-color:#6777ef;">
        <tr>
<th style="color: #fff;">Dia</th>
        <th style="color: #fff;">Personalizado</th>
        <th style="color: #fff;">Personalizado Departamental</th>
        <th style="color: #fff;">Punto Fijo</th>
        
        <th style="color: #fff;">Casillero</th>
        
  
        
        
    </tr>
</thead>
<tbody>
   
@for ($i=0; $i< count($pedidos); $i++)
    <tr >
        
    
    <td style="font-weight: bolder; color: #484f55;">
    
    <input hidden type="text" value=" {{$fecha= $pedidos[$i]->fecha_entrega}}">
    
    
    <input hidden type="text" value=" {{ $fechaa = strtotime($pedidos[$i]->fecha_entrega)}}">
    
   
    {{ strftime('%A %e de %B de %Y', $fechaa)}}
    </td>
    <td style="font-weight: bolder; color: #484f55;">
    
    @if($pedidos[$i]->sumap>0)
    {{ $pedidos[$i]->sumap }}
    @else
    0
    @endif
</td>

<td>  
    @if($pedidos[$i]->sumacd>0)
    {{ $pedidos[$i]->sumacd }}
    @else
    0
    @endif
    </td>
    <td>  
    @if($pedidos[$i]->sumapf>0)
    {{ $pedidos[$i]->sumapf}}
    @else
    0
    @endif
    </td>
   
        
    <td>  
    @if($pedidos[$i]->sumac>0)
    {{ $pedidos[$i]->sumac }}
    @else
    0
    @endif
    </td>

   
    
        
  
   
   
    
</tr >
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

        dom: '<"cambiar" f><"botonexcel" B><"pagina2" p><"cambiar2"l>tri<"pagina1" p>',
        
        buttons: [
                {
                extend: 'excel',
                title: 'Melo Express - Reporte de Cobros',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ],
                   
                }
            }
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
