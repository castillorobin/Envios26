@extends('layouts.app')

@section('content')
<style>
    .modal-backdrop {
  z-index: 0;
}
</style>
<script languague="javascript">
       

        function mostrando()
{
  var checkbox = document.getElementById('check2');
  if (checkbox.checked != true)
  {
    div = document.getElementById('flotante');
            div.style.display = 'none';
            div2 = document.getElementById('flotante2');
            div2.style.display = 'none';

  }else{
    div = document.getElementById('flotante');
            div.style.display = '';
            div2 = document.getElementById('flotante2');
            div2.style.display = '';
  }
}

</script>
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
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Melo Express</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card"> 
                        <div class="card-body">

                            <h3 class="text-center">Facturación</h3>
                        
            <div class="row  py-2" style="background-color: white;" >   <!-- Inicia fila General -->
            <div class="col-12 text-center pt-3 mb-3" style="background-color:#e85f24; color:white; height:75px;">  <!-- Inicia columna total  -->
<H1>Total $ <label for="" id="preci">0</label></H1>

</div> <!-- Termina columna total  -->
<div class="col-12">   <!-- Inicia columna 8  -->
                
                <div class="row mt-1 mr-1">   
                        
                    <div class="col-sm-4 mt-4"> <!-- div buscar -->
                    <form action="/facturasfiltro" method="GET" id="myForm" >
                    @method('GET') 
                        <div class="input-group mb-3 ">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"> <i class="fas fa-search"></i> </span>
                            </div>
                            <select class="form-control mi-selector" name="comercio" id="comercio">
                                <option value="">Buscar Comercio</option>
                                 @for($i=0;  $i< count($vendedores); $i++ )
                                <option value="{{$vendedores[$i]->nombre}}">{{ $vendedores[$i]->nombre }} </option>
               
                                @endfor
                            </select>
                        </div>
                    </div> <!-- Termina div buscar  -->
             
                <div class="col-4 mt-4">  <!-- div filtrros  -->
                               
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
                         
             Desde
            <input type="date" name="desde" id="desde" class="form-control col-4" > 
           Hasta
            <input type="date" name="hasta" id="hasta" class="form-control col-4 " >
                
        
            </div> <!-- Termina div filtros  -->
        
            <div class="col-2 mt-4"> 
            <button type="submit" class="btn btn-primary" tabindex="19">Buscar</button>
            
        </form>


        <a href="/factura/listado">
<button type="button" class="btn btn-warning"  style="float:right">
 Detalles de pago
</button></a>
</div> 

        </div> <!-- Termina div filtros  -->
            
        
        
         
            <div class="col-12">
           
           
            <span style="font-size:18px; color: red;"> {{ $nota }} &nbsp; </span>
        
        
                    <div class="d-flex justify-content-end">
                    
                 
          
                    </div>

              


<div class="col-12 table-responsive " style="height:700px; " > <!-- div tabla  -->
<table id="tvendedor" class="table table-striped " style="  ">
<thead style="background-color:#6777ef;"> 
    <tr >
        <th>*</th>
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
        <th style="color: #fff;">Agencia</th>
        <th style="color: #fff;">Opciones</th>
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
    <td  ></td>
    <td  ></td>
    <td  ></td>
    <td  ></td>
    <td  ></td>
    <td  ></td>
</tr>



<tr class="text-center" style="background-color:#6777ef; height:5px;">
    
    <td style="color: #fff; height:5px;" colspan="2">SUMAS</td>
    <td style="color: #fff; height:5px;">IVA </td>
    <td  style="color: #fff; height:5px;">SUBTOTAL</td>
    <td  style="color: #fff; height:5px;" colspan="2">VENTA NO SUJETA </td>
    <td  style="color: #fff; height:5px;" colspan="2">VENTA EXCENTA </td>
    <td  style="color: #fff; height:5px;" colspan="2">TOTAL</td>
    <td style="color: #fff; height:5px;"></td>
    <td style="color: #fff; height:5px;"></td>
    <td style="color: #fff; height:5px;"></td>
    
     
    
   
</tr>

<tr class="text-center">    
<td colspan="2">$000.00</td>
    <td>$000.00</td>
    <td > $000.00</td>
    <td  colspan="2">$000.00</td>
    <td  colspan="2">$000.00</td>
    <td  colspan="2">$000.00</td>
    <td >  </td>
    <td> </td>
   <td></td>

</tr>


</table>

</div><!-- termina div tabla  -->
<div class="col-6 my-4">
&nbsp; &nbsp;
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal"> Pagar</button> 
  &nbsp;  &nbsp; <a href="/facturas" class="btn btn-danger">Cancelar</a>
    <br>
    <p></p>
    &nbsp;
    <p></p>
    </div>

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
