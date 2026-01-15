@extends('layouts.app')

@section('content')
<style>
    .modal-backdrop {
  z-index: 0;
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
    //window.location = "https://appmeloexpress.com/facturasfiltro/" + data.text; 
    //window.location = "http://127.0.0.1:8000/facturasfiltro/" + data.text;
        });

    });
   
   
});



</script>



<script>
        function doSearch()

{
 
    const tableReg = document.getElementById('datos');

    const searchText = document.getElementById('searchTerm').value.toLowerCase();

    let total = 0;



    // Recorremos todas las filas con contenido de la tabla

    for (let i = 1; i < tableReg.rows.length; i++) {

        // Si el td tiene la clase "noSearch" no se busca en su cntenido

        if (tableReg.rows[i].classList.contains("noSearch")) {

            continue;

        }



        let found = false;

        const cellsOfRow = tableReg.rows[i].getElementsByTagName('td');

        // Recorremos todas las celdas

        for (let j = 0; j < cellsOfRow.length && !found; j++) {

            const compareWith = cellsOfRow[j].innerHTML.toLowerCase();

            // Buscamos el texto en el contenido de la celda

            if (searchText.length == 0 || compareWith.indexOf(searchText) > -1) {

                found = true;

                total++;

            }

        }

        if (found) {

            tableReg.rows[i].style.display = '';

        } else {

           

            tableReg.rows[i].style.display = 'none';

        }

    }



    // mostramos las coincidencias

    const lastTR=tableReg.rows[tableReg.rows.length-1];

    const td=lastTR.querySelector("td");

    lastTR.classList.remove("hide", "red");

    if (searchText == "") {

        lastTR.classList.add("hide");

    } else if (total) {

        td.innerHTML="";

    } else {

        lastTR.classList.add("red");

        td.innerHTML="";

    }

}
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

                            <h3 class="text-center">Listado no retirados</h3>
                        
            <div class="row  py-2" style="background-color: white;" >   <!-- Inicia fila General -->
            <!-- Termina columna total  -->
<div class="col-12">   <!-- Inicia columna 8  -->
                
                <div class="row mt-1 mr-1">   
                        
                    <div class="col-sm-2 mt-4"> <!-- div buscar -->
                    <form action="/pedido/noretiradofiltro" method="GET" id="myForm" >
                    @method('GET') 
                        <div class="input-group mb-3 ">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"> <i class="fas fa-search"></i> </span>
                            </div>
                            <select class="form-control mi-selector" name="repartidor" id="repartidor">
                                <option value="no">Buscar Repartido</option>
                                 @for($i=0;  $i< count($repartidores); $i++ )
                                <option value="{{$repartidores[$i]->nombre}}">{{ $repartidores[$i]->nombre }} </option>
               
                                @endfor
                            </select>
                        </div>
                    </div> <!-- Termina div buscar  -->
             
                <div class="col-2 mt-4">  <!-- div filtrros  -->
                               
                        <select class="form-control" name="rango" id="rango" >
                        <option value="rango">Rango</option>
                            <option value="ahora">Ahora</option>
                            <option value="semana">última Semana</option>
                            <option value="semana2">últimos 30 dias</option>   
                            <option value="mes">último mes</option>         
                        </select>
        &nbsp; &nbsp; &nbsp;
                           
                </div> <!-- Termina div filtros  -->
                <div class="col-2 mt-2 d-flex justify-content-between align-items-center">  <!-- div filtrros   <input type="date" id="fecha" name="fecha" class="form-control" >-->
                         
                    <div class="input-group">

                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/deliver-food.png"/></span>
                        </div>
                        <select id="estado" name="estado" class="form-control mi-selector" >
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
                
        
            </div> <!-- Termina div filtros  -->
        
            <div class="col-2 mt-4"> 
            <button type="submit" class="btn btn-primary" tabindex="19">Buscar</button>
            
        </form>


       
</div> 

        </div> <!-- Termina div filtros  -->
            
        
        
         
            <div class="col-12">
           
           
            <span style="font-size:18px; color: red;">  &nbsp; </span>
        
        
                    <div class="d-flex justify-content-end">
                    
                 
          
                    </div>

              
                    <div class="col-12 table-responsive " style="height:700px; " > <!-- div tabla  -->
                    <div style="float:right;">

<input id="searchTerm" class="form-control mb-3" placeholder="Buscar" type="text" onkeyup="doSearch()" />
</div>


 <!-- div tabla  -->
<table id="datos" class="table table-striped " >
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
        
        <th style="color: #fff; " >Opciones</th>
    </tr>
</thead>
<tbody> 
</tbody> 
@for($i=0;  $i< count($pedidos); $i++ )
<tr>
<td  >{{$pedidos[$i]->vendedor}} </td>
    <td  >{{$pedidos[$i]->destinatario}}</td>
    
    <td  >{{$pedidos[$i]->direccion}}</td>
    <td  >{{$pedidos[$i]->tipo}}</td>
    <td  >{{$pedidos[$i]->estado}}</td>
    <td  >{{  date('d/m/Y', strtotime($pedidos[$i]->fecha_entrega))}}</td>
    @if($pedidos[$i]->pagado=='Pagado')
    <td class="text-center"><h5><span class="badge badge-success ">{{ $pedidos[$i]->pagado }} </span></h5></td>
    @else
    <td class="text-center"><h5><span class="badge badge-danger ">{{ $pedidos[$i]->pagado }} </span></h5></td>
    @endif
    <td  >{{ $pedidos[$i]->precio }} </td>
    <td  >{{ $pedidos[$i]->envio }}</td>
    <td  >{{ $pedidos[$i]->total }} </td>
    
    <td  >

        <a href="/pedido/cambiarnt/{{ $pedidos[$i]->id }} " class="edit btn btn-warning" style="width: 100px;" >No retirado</a>

    </td>
</tr>

@endfor




</table>
</div>
<!-- termina div tabla  -->

                </div> <!-- Termina columna 12 -->
     
                </div>  <!-- Termina columna 8  -->
             
            </div> <!-- Termina fila General -->
                            
         
            <!-- Termina Modal -->






                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>




	
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />


    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" defer></script>

    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js" defer></script>

                 
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js" defer></script>


        

<script>
         
         $(document).ready(function () {
     $('#tabla2').DataTable(
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
 
         dom: 'fpltrip',
         
         
        
        
 
         } 
     );
 }); 
     </script>
@endsection
