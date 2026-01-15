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
            /*
    //console.log(data.text);
    //document.getElementById('mostrar').value = data.text;
    window.location = "https://appmeloexpress.com/factura/listadopagosfiltro/" + data.text; 
    //window.location = "http://127.0.0.1:8000/factura/listadopagosfiltro/" + data.text;
*/        
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

                            <h3 class="text-center">Listado de Pagos</h3>
                        
            <div class="row  py-2" style="background-color: white;" >   <!-- Inicia fila General -->
           
       
 
            <div class="col-12">
 
        

 <form action="/factura/listadopagosfiltro" method="get">
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
   
 <div class="input-group ">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1"> <i class="fas fa-search"></i> </span>
</div>

<select class="form-control mi-selector" name="usuario" id="comer">
    <option value="">Buscar Cajero</option>
    @for($i=0;  $i< count($usuarios); $i++ )
                    <option value="{{$usuarios[$i]->name}}">{{ $usuarios[$i]->name }} </option>
       
                        @endfor
</select>

</div>
</div>
                     </td>
                     <td>
                         
                     </td>
                     <td>
                     
                     <button type="submit" class="btn btn-primary " style="width:45px; height:40px; border-radius: 5px;" > <i class="fas fa-search"></i></button>      
     <a href="/factura/listadopagos" class="btn btn-danger " style="width:45px; height:40px; border-radius: 5px;" > <i class="fas fa-times" style="color: #ffffff;"></i></a>
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
                        
                     </td>
                 </tr>
                 
</form>

                     
             </table>
         <div >


<br>
         </div>



         </div>







</div> <!-- Termina div buscar  -->

<div class="col-12 table-responsive " style="height:500px; " > <!-- div tabla  -->
<table id="tvendedor" class="table table-striped " style="  ">
<thead style="background-color:#6777ef;"> 
    <tr >
        
        <th style="color: #fff;">Cajero</th>
        <th style="color: #fff;">Medio</th>
        <th style="color: #fff;">Comercio</th>
        <th style="color: #fff;">Fecha de pago</th>
        <th style="color: #fff;">Tipo</th>
        <th style="color: #fff;">Comprobante</th>
        <th style="color: #fff;">Descuento</th>
        <th style="color: #fff;">Total</th>
        <th style="color: #fff;">Nota</th>
        <th style="color: #fff;">Opciones</th>
        
     
       
    </tr>
</thead>
<tbody> 


@for($i=0;  $i< count($facturas); $i++ )
<tr>
                    
                    <td>{{ $facturas[$i]->cajero }} </td>
                    <td>{{ $facturas[$i]->medio }} </td>
                    <td>{{ $facturas[$i]->comercio }} </td>
                    <td>{{  date('d/m/Y', strtotime($facturas[$i]->fechapago))  }}</td>
                    <td>{{ $facturas[$i]->tipo }} </td>
                    <td>{{ $facturas[$i]->numerocompro }} </td>
                    <td>{{ $facturas[$i]->descuento }} </td>
                    <td>{{ $facturas[$i]->total }} </td>
                    <td>{{ $facturas[$i]->nota }} </td>
                   
                   
    
                    <td>
                    <a href="/factura/detalles/{{ $facturas[$i]->id }}" class="edit btn btn-warning" target="_blank">Detalles</a></li> 
                    
                    </td>




                    </tr>
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
   
</tr>


 


</table>

</div><!-- termina div tabla  -->


                </div> <!-- Termina columna 12 -->
     
                </div>  <!-- Termina columna 8  -->
             
            </div> <!-- Termina fila General -->
                            
         
            
            
        

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
