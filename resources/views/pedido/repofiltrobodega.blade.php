
@extends('layouts.app')

@section('content')
{{date_default_timezone_set('America/El_Salvador') }}

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>  
jQuery(document).ready(function($){
    $(document).ready(function() {
       $('.mi-selector').select2({
        placeholder: "Estado"
       });

       $('.mi-selector1').select2({
        placeholder: "Comercio"
       });
       
      

    });
   
   
});



</script>




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
  var checkbox = document.getElementById('check4');
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


    <section class="section">
        <div class="section-header" >
        <div style="width:100%; ">
            <div>
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
 
.botonexcel {
        margin-left: 20px;
        
   float: left;
   
   }

.dt-buttons button {
    background: #ffc107 ;
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
 
        

    <form action="/reportes/repofiltrobodega" method="get">
            <div class="">
                <table>
                    <tr>
                        <td style="width:400px;">
                        <!-- Repartidor -->
  
    
    <div class="col-sm-12 ">
        
        <div class="input-group">

          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/external-kmg-design-detailed-outline-kmg-design/25/null/external-delivery-man-logistics-delivery-kmg-design-detailed-outline-kmg-design-2.png"/></span>
          </div>
          <select id="repartidor" name="repartidor[]" class="form-control mi-selector1" multiple="multiple">
            <option value="repartidor">Comercio</option>
            @foreach($repartidores as $repartidor)
            <option value="{{ $repartidor->nombre }}">{{ $repartidor->nombre }}</option>
            @endforeach
          </select>
            
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

                        <button type="submit" class="btn btn-primary " style="width:45px; height:40px; border-radius: 5px;" > <i class="fas fa-search"></i></button>      
        <a href="/reportes/repobodega" class="btn btn-danger " style="width:45px; height:40px; border-radius: 5px;" > <i class="fas fa-times" style="color: #ffffff;"></i></a>

    
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




<div class="table-responsive">



<br>
<table id="tpedido" class="table table-striped mt-2">
<thead style="background-color:#6777ef;">
        
<th style="color: #fff;">ID</th>
        <th style="color: #fff;">Comercio</th>
        <th style="color: #fff;">Destinatario</th>
        <th style="color: #fff;">Direccion</th>
        
        <th style="color: #fff;">Tipo</th>
        <th style="color: #fff;">Estado del envio</th>
        <th style="color: #fff;">Fecha de entrega</th>
        <th style="color: #fff;">Nota</th>
        <th style="color: #fff;">Estante</th>
        
        
        <th style="color: #fff;">Opciones</th>
    </tr>
</thead>
<tbody>
   
@for($i=0;  $i< count($pedidos); $i++ )
<tr>
                    
                    <td>{{ $pedidos[$i]->id }} </td>
                    <td>{{ $pedidos[$i]->vendedor }} </td>
                    <td>{{ $pedidos[$i]->destinatario }} </td>
                    <td>{{ $pedidos[$i]->direccion }} </td>
                    <td>{{ $pedidos[$i]->tipo }}</td>  
                    <td >{{ $pedidos[$i]->estado }}</td>
                    <td>{{  date('d/m/Y', strtotime($pedidos[$i]->fecha_entrega))}} </td>


                    
                    <td>{{ $pedidos[$i]->nota }} </td>
                    <td>{{ $pedidos[$i]->estante }} </td>
                   
   

    


                    <td class="opciones text-center" style="">

  

<button type="button"  class="edit btn btn-warning" data-toggle="modal" value="{{ $pedidos[$i]->id }}" data-target="#exampleModal5" >Cambiar</button>
  

    </td>




                    </tr>
                        @endfor

</tbody>
</table>







      
            <!-- Empieza Modal -->

            <!-- Modal -->
<!-- Modal estatus en lote-->
<form action="/reportes/cambiarbodega" method="get">
<div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar Estado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <select id="estadom" name="estadom" class="form-control" tabindex="9" onChange="jsFunction()" >
            <option value="Creado" onclick="jsFunction()">Creado</option>
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

        <select id="repartidorm" name="repartidorm" class="form-control" tabindex="15">
            <option value="">-Sin asignar-</option>
            @foreach($repartidores as $repartidor)
            <option value="{{ $repartidor->nombre }}">{{ $repartidor->nombre }}</option>
            @endforeach
          </select>

    </div>

</div>







<div class="col-12">
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="check4" name="check4" Onclick="javascript:mostrando2();">
            <label class="form-check-label" for="check4">Caja o Estante</label>
        </div>
</div>


<div class="col-6" id="flotante2" style="display:none;">

    <div class="input-group ">
        <div class="input-group-prepend">
            
        </div>

        <input type="text" id="estante" name="estante">

    </div>

</div>


<div class="form-group form-check">
            
            <label class="form-check-label" for="check4">Nota</label>
        </div>
<div class="input-group ">
        <div class="input-group-prepend">
            
        </div>

        <input class="form-control" type="text" id="nota" name="nota">

    </div>





      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Actualizar</button>
        
        </form>
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
        
  
        $('#edit').modal('show');
        $('#prueba').text(id);
        //$('#proba').value(id);
      
 

        document.getElementById("proba").value = id;
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

       // dom: '<"cambiar" f><"pagina2" p><"cambiar2"l>tri<"pagina1" p>',
        
       dom: '<"cambiar" f> <"botonexcel" B><"pagina2" p><"cambiar2"l>tri<"pagina1" p>',
            buttons: [
                {
                extend: 'excel',
                title: 'Melo Express',
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5, 6, 7, 8],
                    page: 'all',
                   
                }
            },
            
            [
                {
                extend: 'pdfHtml5',
                
                  title: 'Melo Express',
                  orientation: 'landscape',
                 
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5, 6, 7, 8],
                    
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
