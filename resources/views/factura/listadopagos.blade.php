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
    //window.location = "https://appmeloexpress.com/factura/listadopagosfiltro/" + data.text; 
    //window.location = "http://127.0.0.1:8000/factura/listadopagosfiltro/" + data.text;
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
                        
            <div class="row py-2" style="background-color: white;" >   <!-- Inicia fila General -->
           

            
 
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



<div class="col-12 table-responsive " > <!-- div tabla  -->
<table id="tvendedor" class="table table-striped " style="  ">
<thead style="background-color:#6777ef;"> 
    <tr >
       
    <th style="color: #fff;">Cajero</th>
        <th style="color: #fff;">Medio</th>
        <th style="color: #fff;">Fecha de pago</th>
        <th style="color: #fff;">Tipo</th>
        <th style="color: #fff;">Comprobante</th>
        <th style="color: #fff;">Descuento</th>
        <th style="color: #fff;">Nota</th>
    </tr>
</thead>
<tbody> 
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
                            
         
            
            
            <!-- Empieza Modal -->

            <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pagar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        

      <div class="col-12 border px-0 mt-1">  <!-- Inicia columna 4  -->
      <div class="col-12 text-center pt-2 mb-3" style="background-color:#e85f24; color:white; height:75px;">  <!-- Inicia columna total  -->
<H1>Total $ <label for="" id="preci">0</label></H1>

</div> <!-- Termina columna total  -->
<div class="col-12">  <!-- Inicia cajero, pagos etc. -->

Cajero
<input type="text" class="form-control" name="cajero" id="cajero" value="" readonly>
<br>
<div class="row pt-2">
    
<div class="col-6">Medio de pago
    <select name="medio" id="medio" class="form-control">
        <option value="Efectivo">Efectivo</option>
        <option value="Deposito">Deposito</option>
        <option value="Tigo Money">Tigo Money</option>
        <option value="Chivo">Chivo</option>
    </select>

</div>
<div class="col-6">
    

Fecha de pago

<div class="input-group ">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/tear-off-calendar.png"/></span>
</div>

<input type="text" class="form-control" name="fpago" id="fpago" value="{{ date('d/m/Y') }}" aria-label="Username" aria-describedby="basic-addon1" readonly>

</div>





</div>
</div>



<br>

<div class="row pt-2">
    
<div class="col-6">Tipo de comprobante
    <select name="medio" id="medio" class="form-control">
        <option value="Efectivo">Ticket</option>
        <option value="Deposito">Factura</option>
        <option value="Tigo Money">Crédito Fiscal</option>
        <option value="Tigo Money">PDF</option>
        
    </select>

</div>
<div class="col-6">
    

No. de comprobante

<div class="input-group ">
<div class="input-group-prepend">

</div>

<input type="text" class="form-control" name="fpago" id="fpago" aria-label="Username" aria-describedby="basic-addon1" >

</div>





</div>
</div>
<br>

<div class="col-12">
<div class="form-group form-check">
<input type="checkbox" class="form-check-input" id="check1">
<label class="form-check-label" for="check1">IVA</label>
</div>
<div class="form-group form-check">
<input type="checkbox" class="form-check-input" id="check2" Onclick="javascript:mostrando();">
<label class="form-check-label" for="check2">Hacer descuento</label>
</div>

</div>







<div class="col-6" id="flotante" style="display:none;">

<div class="input-group ">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1"> <i class="far fa-money-bill-alt"></i> </span>
</div>

<input type="text" class="form-control" name="fpago" id="fpago"  aria-label="Username" aria-describedby="basic-addon1">

</div>






</div>
</div>

<br>
<div class="col-12" id="flotante2" style="display:none;">
Nota de descuento
<input type="text" class="form-control" name="fpago" id="fpago"  aria-label="Username" aria-describedby="basic-addon1">
</div>









<br>
<div class="col-12 mb-3">
<button type="button" class="btn btn-lg btn-warning btn-block">PAGAR</button>
</div>

</div> <!-- Termina cajero, pagos etc.  -->
</div> <!-- Termina columna 4  -->



      </div>
      <div class="modal-footer " style="background-color:white;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
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
         <script>
        
$(document).ready(function(){
	$(document).on('click', '#check3', function(){
		var id=$(this).val();
		var prec=$('#pre'+id).text();
        
        //alert("le diste click" + prec);
        var tota = $('#preci').text();
        if ($(this).prop('checked')) {
            var to3 = parseFloat(tota, 10) + parseFloat(prec, 10);
        $('#preci').text(to3);  
        } else {
            var to3 = parseFloat(tota, 10) - parseFloat(prec, 10);
        $('#preci').text(to3);  
        }
        
        
        //var tota = document.getElementById("pre").val;
        
       // $('#preci').text(tota.toString() + 'hola' );  
     

    });
   
    
    

    

   // $(document).on('change', '.selection', function(){   
//console.log('Hola');
 //   });
    
});
 




        </script> 
@endsection
