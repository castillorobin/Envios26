
@extends('layouts.app')

@section('content')
{{date_default_timezone_set('America/El_Salvador') }}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    
     
   
<script>

function mostrando()
{
  
 



  //inicia archivo webcam

  
  // finalizo archivo webcam






 
  









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


    function redireccionarPagina(){
    window.setTimeout( abrirURL, 2000 ); // 3 segundos
};
    
function abrirURL(){
    //Abrir URL que necesites
    //window.location = "http://127.0.0.1:8000/pedidos";
    window.location = "https://appmeloexpress.com/pedidos/create";
};
</script>
 
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Crear Envio</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card"> 
                    <div class="card-body" style="background-color:#ffffff">
                            <h3 class="text-center">Datos del Envio</h3>
                        </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
body {
 
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
.select2-selection{
  height: 35px !important;
 
}
</style>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
   $('.js-example-basic-single').select2({
 placeholder: "Busca alguno de tus lugares",
 });
</script>
<script>
 
function myFunction() {
  document.getElementById("myForm").reset();
}
 $(document).ready(function() {
  
   					$("#envio").change(function() {
       												 //alert($(this).val());
          const tenv = document.getElementById("cenvio").value;
					const preci = parseFloat(document.getElementById("precio").value);						                                                    
          const envi =parseFloat($(this).val()); 
          
          if(tenv=="Pagado")
          {
            document.getElementById("total").value = preci;
          }else{
            document.getElementById("total").value = preci - envi;
          }
                    

														//const castot = parseFloat(document.getElementById("totalc").value);
														//document.getElementById("ptotal").value = castot ; 

    				});

            $("#precio").change(function() {
       												 //alert($(this).val());
          const tenv2 = document.getElementById("cenvio").value;
					const envi2 = parseFloat(document.getElementById("envio").value);						                                                    
          const preci2 =parseFloat($(this).val()); 
          
          if(tenv2=="Pagado")
          {
            document.getElementById("total").value = preci2;
          }else{
            document.getElementById("total").value = preci2 - envi2;
          }
                    

														//const castot = parseFloat(document.getElementById("totalc").value);
														//document.getElementById("ptotal").value = castot ; 

    				});


            $("#cenvio").change(function() {
       												 //alert($(this).val());
          const tenv3 = document.getElementById("precio").value;
					const envi3 = parseFloat(document.getElementById("envio").value);						                                                    
          const preci3 =document.getElementById("cenvio").value; 
          
          if(preci3=="Pagado")
          {
            document.getElementById("total").value = tenv3;
          }else{
            document.getElementById("total").value = tenv3 - envi3;
          }
                    

														//const castot = parseFloat(document.getElementById("totalc").value);
														//document.getElementById("ptotal").value = castot ; 

    				});
              
                                            });
  

  
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>  
jQuery(document).ready(function($){
    $(document).ready(function() {
        $('.mi-selector').select2();
    });
});
</script>

<script>
  $(document).ready(function() {
  $("input").focusout(function() {
    var value = $(this).val();
    if (value.length == 0) {
      $(this).addClass("is-invalid");
      $(this).removeClass("is-valid");
    } else {
      $(this).removeClass("is-invalid");
      $(this).addClass("is-valid");
    }
    /*
           
    */
    console.log('Este campo es obligatorio');
  });
});

$(document).ready(function() {
  $("select").focusout(function() {
    var value = $(this).val();
    if (value.length == 0) {
      $(this).addClass("is-invalid");
      $(this).removeClass("is-valid");
    } else {
      $(this).removeClass("is-invalid");
      $(this).addClass("is-valid");
    }
    /*
           
    */
    console.log('Este campo es obligatorio');
  });
});
</script>



<form action="/pedidos" method="POST" id="myForm" enctype="multipart/form-data" >
    @csrf

       
  <div class="row mx-1" >
   
      <div class="alert alert-danger mx-5 mt-4" role="alert">
      <i class="fas fa-exclamation-circle"></i> Estimado usuario los campos con * son obligatorios
      </div>
  </div>
  



  <div class="row mx-5 mt-4" >
    <h4>Datos del Comercio</h4>
  </div>
  
  <div class="row mx-5 border py-4" style="background-color: white; border-radius: 10px;" >
<div class="col-12">
  
    <div class="row " style="background-color: white; " >
      <div class="col-12">
        <div class="row">
        <div class="  col-sm-6">
          <label for="inputEmail3" class="col-sm-4 col-form-label">Id de envio</label>
            <div class="input-group mb-3 col-5">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/fluency-systems-regular/48/null/checked-identification-documents.png" width="25" /></span>
              </div>
              <input type="text" class="form-control" placeholder="{{ $last->id }}" aria-label="Username" aria-describedby="basic-addon1" disabled>
            </div>
        </div>
   
        <div class="col-sm-4 text-center">
          <label for="inputEmail3" class="col-sm-8 col-form-label"></label>

        </div>

        </div>

      </div> 

      <div class="col-12">
        <div class="row py-1" style="background-color: white;" >

        <div class="col-10">
          <label for="" class="col-10 col-form-label">Nombre de comercio / Tienda *</label>
   
          <select id="comer" name="comer" class="form-control mi-selector" data-placeholder="Seleccionar..." required tabindex="1">
            <option value="">-Seleccionar comercio-</option>
     
            @foreach($vendedores as $vendedor)
            <option value="{{ $vendedor->nombre }}">{{ $vendedor->nombre }}</option>
            @endforeach
          </select>
          <div class="invalid-feedback">Este campo es obligatorio.</div>
      <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>  
        </div>

        <div class="col-2 pt-4" style="display: flex; align-items: center; ">
            <a href="/pedido/desdeenvio">+ Crear</a>
        </div>
         
        </div>
      </div>
    </div>
</div> 


</div>
  <div class="row mx-5 mt-4 " >
      <h4>Datos del destinatario</h4>
  </div>

  <div class="row mx-5 border py-4" style="background-color: white; border-radius: 10px;" >
  <div class="col-12">

  <div class="row " style="background-color: white; " >
   
      <div class="col-6 ">
        <label for="inputEmail3" class="col-6 col-form-label">Destinatario *</label>
        <input type="text" id="desti" name="desti" class="form-control" tabindex="2" placeholder="Ingrese el nombre del destinatario" required>
        <div class="invalid-feedback">Este campo es obligatorio.</div>
        <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>      
      </div>
    
      <div class="col-6">
        <label for="inputEmail3" class="col-6 col-form-label">Telefono</label>
        <input type="text" id="telefono" name="telefono" class="form-control" tabindex="3" placeholder="Ingrese teléfono del destinatario" aria-describedby="basic-addon1" data-inputmask="'mask': '9999-9999'">
     
        <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>    
      </div>
    
      <div class="col-12">
        <label for="" class="col-12 col-form-label">Direccion de entrega *</label>
        <div class="input-group mb-3">

          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/glyph-neue/25/null/order-delivered.png"/></span>
          </div>
            <input type="text" maxlength="64" id="direccion" name="direccion" class="form-control" placeholder="Ingrese la dirección de entrega del destinatario" aria-label="Username" aria-describedby="basic-addon1" tabindex="4" required>
            <div class="invalid-feedback">Este campo es obligatorio.</div>
            <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>      
        </div>
      </div>

                                    

    </div>
    </div>
  
    </div>
  
  <div class="row mx-5 mt-4 " >
      <h4>Datos del paquete</h4>
  </div>
 
  <div class="row mx-5 border py-1" style="background-color: white; border-radius: 10px;">
  <div class="col-12">
    <div class="row " style="background-color: white; ">

    
        <div class="col-6 ">
          <label for="" class="col-sm-6 col-form-label">Fecha de creacion</label>

          <div class="input-group ">
            <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/tear-off-calendar.png"/></span>
            </div> 
           
            <input type="text" class="form-control" value="{{ date('d/m/Y h:i:s') }}" aria-label="Username" aria-describedby="basic-addon1" readonly>
            <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>   
          </div>
        
        </div>
    
        <div class="col-sm-6">
              <label for="" class="col-sm-6 col-form-label">Fecha de entrega *</label>
            <div class="input-group ">

              <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/tear-off-calendar.png"/></span>
              </div>
              <input type="date" id="fentrega" name="fentrega" tabindex="5" class="form-control" value="{{ now()->Format('Y-m-d') }}" aria-label="Username" aria-describedby="basic-addon1" required>
              <div class="invalid-feedback">Este campo es obligatorio.</div> 
              <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>                                       
            </div>

        </div>
             
    </div>     
  </div>  


  <div class="col-12">
    <div class="row " style="background-color: white;">

    
     
      <div class="col-6 ">
        <label for="" class="col-6 col-form-label">Tipo de servicio</label>
          <div class="input-group">

            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/online-support.png"/></span>
            </div>
            <select id="servicio" name="servicio" class="form-control" tabindex="6">
     
             <option option value="Entrega">Entrega</option>
              <option value="Entrega y recolecta">Entrega y recolecta</option>
  
            </select>
            <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
          </div>
      </div>
     
      <div class="col-6">
        <label for="" class="col-6 col-form-label">Tipo de envio</label>
        <div class="input-group">

          <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/external-kiranshastry-solid-kiranshastry/25/null/external-delivery-logistic-delivery-kiranshastry-solid-kiranshastry.png"/></span>
          </div>
          <select id="tenvio" name="tenvio" class="form-control" tabindex="7">
      
            <option value="Personalizado">Personalizado</option>
            <option value="Personalizado departamental">Personalizado departamental</option>
            <option value="Punto fijo">Punto fijo</option>
            <option value="Casillero departamental">Casillero departamental</option>
            <option value="Casillero San Salvador">Casillero San Salvador</option>
            <option value="Casillero San Miguel">Casillero San Miguel</option>
            <option value="Casillero Santa Ana">Casillero Santa Ana</option>
            <option value="Casillero centro logístico">Casillero centro logístico</option>
          </select>
          <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
        </div>
      </div>                                      
    
    </div>
  </div>
 

    <div class="col-12">
    <div class="row " style="background-color: white;">
   

      <div class="col-4">
        <label for="" class="col-8 col-form-label">Cobro del envio</label>
        <div class="input-group ">

          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/cheap-2.png"/></span>
          </div>
          <select id="cenvio" name="cenvio" class="form-control" tabindex="8">
          <option value="Pendiente">Pendiente</option>
          <option value="Pagado">Pagado</option>
          </select>
          <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>  
        </div>
      </div>
      
      <div class="col-4">
        <label for="" class="col-8 col-form-label">Estado del envio</label>
        <div class="input-group">

          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/deliver-food.png"/></span>
          </div>
          <select id="estado" name="estado" class="form-control" tabindex="9">
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
          <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>  
        </div>
      </div>


      <div class="col-4">
        <label for="" class="col-8 col-form-label">Estado del pago</label>
        <div class="input-group">

          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/cash-in-hand.png"/></span>
          </div>
          <select id="pagado" name="pagado" class="form-control" tabindex="10">
            <option value="Por pagar">Por pagar</option>
            <option value="Pagado">Pagado</option>
            <option value="Trans. a la empresa">Trans. a la empresa</option>
            <option value="Trans. al comercio">Trans. al comercio</option>
            
          </select>
          <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>  
        </div>
      </div>

    
    </div>
    </div>


    <div class="col-12">
    <div class="row " style="background-color: white;">
    

      <div class="col-4">
          <label for="" class="col-8 col-form-label">Precio del paquete</label>
    
        <div class="input-group">

          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/cheap-2.png"/></span>
          </div>
           <input type="text" id="precio" name="precio" class="form-control" placeholder="Precio"  value="0" tabindex="11">
          <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>  
        </div>
      </div>

      <div class="col-sm-4">
          <label for="" class="col-sm-8 col-form-label">Precio del envio</label>
          <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/cheap-2.png"/></span>
          </div>
            <input type="text" id="envio" name="envio" class="form-control" placeholder="Envio" aria-label="Username" value="0" tabindex="12">
            <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>  
          </div>
      </div>


      <div class="col-sm-4">
          <label for="" class="col-sm-8 col-form-label">Total a cobrar</label>
          <div class="input-group mb-3">

            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/cheap-2.png"/></span>
            </div>
            <input type="text" id="total" name="total" class="form-control" aria-label="Username" aria-describedby="basic-addon1" readonly>
          </div>
      </div>

    </div>
    </div>
    </div> 

<div class="row mx-5 mt-4 " >
      <h4>Datos del internos</h4>
  </div>

  <div class="row mx-5 border py-1" style="background-color: white; border-radius: 10px;">
  <div class="col-12">
  <div class="row " style="background-color: white;">
    
    
    <div class="col-6 ">
      <label for="" class="col-6 col-form-label">Usuario que registra</label>
      <div class="input-group">

        <div class="input-group-prepend">
         <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/external-itim2101-lineal-itim2101/25/null/external-operator-logistics-and-delivery-itim2101-lineal-itim2101.png"/></span>
        </div>
        <input type="text" id="ingresado" name="ingresado" value ="{{\Illuminate\Support\Facades\Auth::user()->name}}" class="form-control" aria-label="Username" aria-describedby="basic-addon1" readonly>
        
        </div>
        
    </div>
    
    <div class="col-sm-6">
      <label for="" class="col-sm-6 col-form-label">Recepción agencia</label>
      <div class="input-group">

        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"> <img src="https://img.icons8.com/ios-filled/25/null/online-store.png"/></span>
        </div>
        <select id="agencia" name="agencia" class="form-control" tabindex="14">
          <option value="San Salvador">San Salvador</option>
            <option value="San Miguel">San Miguel</option>
          <option value="Santa Ana">Santa Ana</option>
        </select>
        <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>  
      </div>
    </div>
  
  </div> 
  </div> 


  <div class="col-12">
  <div class="row " style="background-color: white;">
    
      <div class="col-sm-6 ">
        <label for="" class="col-sm-6 col-form-label">Repartidor</label>
        <div class="input-group">

          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/external-kmg-design-detailed-outline-kmg-design/25/null/external-delivery-man-logistics-delivery-kmg-design-detailed-outline-kmg-design-2.png"/></span>
          </div>
          <select id="repartidor" name="repartidor" class="form-control" tabindex="15">
            <option value="">-Sin asignar-</option>
            @foreach($repartidores as $repartidor)
            <option value="{{ $repartidor->nombre }}">{{ $repartidor->nombre }}</option>
            @endforeach
          </select>
          <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>  
        </div>
      </div>
    
      <div class="col-sm-6">
        <label for="" class="col-sm-6 col-form-label">Ruta</label>
        <div class="input-group">

          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"> <img src="https://img.icons8.com/external-wanicon-lineal-wanicon/25/null/external-map-logistics-wanicon-lineal-wanicon.png"/></span>
          </div>
          <select id="ruta" name="ruta" class="form-control" tabindex="16"> 
          <option value="Ruta 1">Sin asignar</option>
          <option value="Ruta 1">Ruta 1</option>
            <option value="Ruta 2">Ruta 2</option>
            <option value="Ruta 3">Ruta 3</option>
            <option value="Ruta 4">Ruta 4</option>
            <option value="Ruta 5">Ruta 5</option>
          </select>
          <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>  
        </div>
      </div>

   
   </div>


   <div class="row " style="background-color: white;">
    

      <div class="col-sm-6 ">
        <label for="" class="col-sm-6 col-form-label">Nota</label>
        <div class="input-group ">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"> <i class="fas fa-file-alt"></i> </span>
          </div>
          <input type="text" id="nota" name="nota" class="form-control" placeholder="Ingresar nota" aria-describedby="basic-addon1" tabindex="17">
          <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>  
        </div>
      </div>

      <div class="col-sm-6">
        <label for="" class="col-sm-8 col-form-label">Caja o estante</label>
        <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"> <i class="fas fa-barcode"></i> </span>
        </div>
        <input type="text" id="estante" name="estante" class="form-control" placeholder="Barras" aria-label="Username" aria-describedby="basic-addon1" tabindex="18">
        <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>  
        </div>
      </div>

    
    </div>
    </div>

 
    <div class="col-12">
  <div class="row" style="background-color: white;">
    
      <label for="inputEmail3" class="col-sm-12 col-form-label">Fotos del paquete</label>

<br/>


<div class="form-group form-check col-md-12">
&nbsp;  &nbsp;   &nbsp; <input type="checkbox" class="form-check-input" id="check2" Onclick="javascript:mostrando();">

<label class="form-check-label" for="check2">Capturar Foto</label>
</div>




<div class="col-md-6 " id="flotante" style="display:none;">
                <div id="my_camera"  ></div>
                <br/>
                <input type="button" value="Tomar foto" onClick="take_snapshot()" class="btn-success " style="margin-left: 200px;">
                <input type="hidden" name="foto" class="image-tag">
            </div>

            <div class="col-md-6" id="flotante2" style="display:none;">
                <div id="results">Esperando foto...</div>
            </div>

            








<br>
<p></p>
      <div class="col-sm-6" style="margin-top: 50px;">
      <input type="file" name="foto2" class="form-control" >
      </div>
      <div class="col-sm-6" style="margin-top: 50px;">
      <input type="file" name="foto3" class="form-control" >
      </div>
      
      <br>
    </div>
    <br>
  </div>
  </div>
 
  <div class="col-12">
  
  <div class="row mx-5 py-1" style="background-color: white;">

    <div class="modal-footer">


        <a href="/pedidos" class="btn btn-primary">Cancelar</a>
        &nbsp; &nbsp;
        <!--
      <input type="button" class="btn btn-primary" onclick="myFunction()" value="Limpiar">
-->
<a href="/pedidos/create" class="btn btn-primary">Limpiar</a>
      &nbsp; &nbsp;
        <button type="submit" class="btn btn-primary" tabindex="19">Guardar</button>
        <a href="/pedidos/imprimire" onclick="redireccionarPagina()" target="_blank"><button type="submit" formtarget="_blank" name="impri" class="btn btn-primary" >Guardar e Imprimir</button></a>
    </div>

  
  </div>
  </div>


   

<p></p> 



                                        

   
</form>
   



<br>
<p></p>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.3/jquery.inputmask.bundle.min.js"></script>


   
 
<script>
  $(document).ready(function(){
  
 /* $(":input").inputmask();*/
 Inputmask().mask(document.querySelectorAll("input"));
});
</script>

<script>



Webcam.set({
        width: 490,
        height: 350,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    
   
    Webcam.attach( '#my_camera' );
    
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
        div = document.getElementById('flotante');
            div.style.display = 'none';
    }

</script>
</div>
                    </div>
                </div> 
            </div>
        </div>
    </section>    
@endsection
