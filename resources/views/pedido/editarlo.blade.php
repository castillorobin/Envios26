
@extends('layouts.app')

@section('content')

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

    input[type="date"]::before {
	color: #999999;
	content: attr(placeholder);
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
.select2-selection{
  height: 35px !important;
 
}
</style>

<script>

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>  
jQuery(document).ready(function($){
    $(document).ready(function() {
        $('.mi-selector').select2();
    });
});
</script>
<script>
function myFunction() {
  document.getElementById("myForm").reset();
}
$('#nombre').on('select2:change', function (e) {
  window.alert("Bienvenido a nuestro sitio web");
    document.getElementById("direccion").value = 'cambio esto';
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


    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Envio</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card"> 
                    <div class="card-body">
                            <h3 class="text-center">Datos del Envio</h3>
                        </div>

 
<form action="/pedido/editarlo/{{$pedido->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('GET')
    
    
    
   
    <div class="row mx-5" >
    
      <div class="alert alert-danger" role="alert">
      <i class="fas fa-exclamation-circle"></i> Estimado usuario los campos con * son obligatorios
      </div>
    </div>
  <br>



    <div class="row mx-5" >
    <h4>Datos del Comercio</h4>
    </div>

    <div class="row border mx-5 py-4" style="background-color: white;" >
    

    
                <div class="  col-6">
                    <label for="inputEmail3" class="col-4 col-form-label">Id de envio</label>
                  <div class="input-group mb-3 col-5">

                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/fluency-systems-regular/48/null/checked-identification-documents.png" width="25" /></span>
                     </div>
                    <input type="text" class="form-control" value=" {{$pedido->id}}" aria-label="Username" aria-describedby="basic-addon1" disabled>
                  </div>
                </div>
   
                <div class="col-4 text-center">
                    <label for="inputEmail3" class="col-8 col-form-label">Codigo de barras</label>
                    <img width="110" src="vendor/adminlte/dist/img/barra.jpg" alt="" >
                </div>
                <div class="col-12">
                   <label for="" class="col-12 col-form-label">Nombre de comercio / Tienda *</label>
                <select id="comer" name="comer" class="form-control">
                  <option value="{{$pedido->vendedor}}" selected >{{$pedido->vendedor}}</option>
                  @foreach($vendedores as $vendedor)
                    <option value="{{ $vendedor->nombre }}">{{ $vendedor->nombre }}</option>
                  @endforeach
                </select>
                <div class="invalid-feedback">Este campo es obligatorio.</div>
            <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
            </div>




    </div>
    <br><p></p>


  <div class="row mx-5 mt-4 " >
      <h4>Datos del destinatario</h4>
  </div>

  <div class="row border mx-5 py-4" style="background-color: white;" >
    
          <div class="col-6 ">
            <label for="inputEmail3" class="col-sm-4 col-form-label">Destinatario *</label>
            <input type="text" id="desti" name="desti" class="form-control" tabindex="3" value=" {{$pedido->destinatario}} " required>
            <div class="invalid-feedback">Este campo es obligatorio.</div>
            <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
          </div>
    
          <div class="col-6">
            <label for="inputEmail3" class="col-4 col-form-label">Telefono</label>
            <input type="text" id="telefono" name="telefono" class="form-control" tabindex="3" value=" {{$pedido->telefono}} ">
            <div class="invalid-feedback">Este campo es obligatorio.</div>
            <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
          </div>

          <div class="col-12">
        <label for="" class="col-6 col-form-label">Direccion de entrega *</label>

        <div class="input-group mb-3">

          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/glyph-neue/25/null/order-delivered.png"/></span>
          </div>
            <input type="text" id="direccion" name="direccion" class="form-control" aria-label="Username" aria-describedby="basic-addon1" value=" {{$pedido->direccion}} " required>
            <div class="invalid-feedback">Este campo es obligatorio.</div>
            <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
        </div>

    </div>
    </div>

  
    
  <div class="row mx-5 mt-4 " >
      <h4>Datos del paquete</h4>
</div>

   <div class="row border mx-5 py-4" style="background-color: white;">
   
      <div class="col-sm-6 ">

            <label for="" class="col-sm-6 col-form-label">Fecha de creacion</label>
          <div class="input-group mb-3">

            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/tear-off-calendar.png"/></span>
            </div>
              <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" value=" {{  date('Y/m/d', strtotime($pedido->created_at))  }} " >
              <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
          </div>
      </div>
     
    <div class="col-sm-6">
        <label for="" class="col-sm-6 col-form-label">Fecha de entrega *</label>
        <div class="input-group mb-3">

          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/tear-off-calendar.png"/></span>
          </div>
          <input type="text" id="fentrega" name="fentrega" class="form-control" aria-label="Username" aria-describedby="basic-addon1" value=" {{  date('Y/m/d', strtotime($pedido->fecha_entrega))  }} " required>
          <div class="invalid-feedback">Este campo es obligatorio.</div>
            <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
        </div>
    </div>
        
    </div>  

      
  <div class="row border mx-5 py-4" style="background-color: white;">

      
    <div class="col-sm-6 ">
          <label for="" class="col-sm-6 col-form-label">Tipo de servicio</label>
          <div class="input-group mb-3">

              <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/online-support.png"/></span>
              </div>
            <select id="servicio" name="servicio" class="form-control"  ">
              <option value="{{$pedido->servicio}}" selected >{{$pedido->servicio}}</option>
                <option value="Entrega">Entrega</option>
                <option value="Entrega y recoelcta">Entrega y recolecta</option>
  
                </select>
                <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
          </div>
    </div>
     
    
    <div class="col-sm-6">
        <label for="" class="col-sm-6 col-form-label">Tipo de envio</label>
      <div class="input-group mb-3">

              <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/external-kiranshastry-solid-kiranshastry/25/null/external-delivery-logistic-delivery-kiranshastry-solid-kiranshastry.png"/></span>
              </div>
        <select id="tenvio" name="tenvio" class="form-control" ">
        <option value="{{$pedido->tipo}}" selected >{{$pedido->tipo}}</option>
       <option value="Personalizado">Personalizado</option>
       <option value="Personalizado departamental">Personalizado departamental</option>
       <option value="Punto fijo">Punto fijo</option>
       <option value="Casillero">Casillero</option>
       <option value="Casillero San Salvador">Casillero San Salvador</option>
       <option value="Casillero San Miguel">Casillero San Miguel</option>
       <option value="Casillero Santa Ana">Casillero Santa Ana</option>
       </select>
       <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
      </div>
    </div>      
    
    
  </div>





  <div class="row border mx-5 py-4" style="background-color: white;">


      <div class="col-sm-4">
              <label for="" class="col-sm-8 col-form-label">Cobro del envio</label>
          <div class="input-group mb-3">

            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/cheap-2.png"/></span>
            </div>
              <select id="cenvio" name="cenvio" class="form-control">
              <option value="{{$pedido->cobroenvio}}" selected >{{$pedido->cobroenvio}}</option>
                <option value="Pendiente">Pendiente</option>
                <option value="Pagado">Pagado</option>
                <option value="Casillero pendiente">Casillero pendiente</option>
      
              </select>
              <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
          </div>
      </div>

      <div class="col-sm-4">
            <label for="" class="col-sm-8 col-form-label">Estado del envio</label>
          <div class="input-group mb-3">

            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/deliver-food.png"/></span>
            </div>
              <select id="estado" name="estado" class="form-control">
                <option value="{{$pedido->estado}}" selected >{{$pedido->estado}}</option>
                <option value="Creado" >Creado</option>
                <option value="En ruta">En ruta</option>
                <option value="Entregado">Entregado</option>
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
              <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
          </div>
      </div>


      <div class="col-sm-4">
          <label for="" class="col-sm-8 col-form-label">Estado del pago</label>
          <div class="input-group mb-3">

            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/cash-in-hand.png"/></span>
            </div>
              <select id="pagado" name="pagado" class="form-control">
                <option value="{{$pedido->pagado}}" selected >{{$pedido->pagado}}</option>
                <option value="Por pagar">Por pagar</option>
                <option value="Pagado">Pagado</option>
                <option value="Trans. a la empresa">Trans. a la empresa</option>
                <option value="Trans. al comercio">Trans. al comercio</option>
              </select>
              <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
          </div>
      </div>
</div>

<div class="row border mx-5 py-4" style="background-color: white;">

<div class="col-sm-4">
<label for="" class="col-sm-8 col-form-label">Precio del paquete</label>
<div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/cheap-2.png"/></span>
</div>
<input type="text" id="precio" name="precio" class="form-control" aria-label="Username" aria-describedby="basic-addon1" value=" {{$pedido->precio}} ">
<div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
</div>
</div>



<div class="col-sm-4">
<label for="" class="col-sm-8 col-form-label">Costo del envio</label>
<div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/cheap-2.png"/></span>
</div>
<input type="text" id="envio" name="envio" class="form-control" aria-label="Username" aria-describedby="basic-addon1" value=" {{$pedido->envio}} ">
<div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
</div>
</div>


<div class="col-sm-4">
<label for="" class="col-sm-8 col-form-label">Total a cobrar</label>
<div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/cheap-2.png"/></span>
</div>
<input type="text" id="total" name="total" class="form-control" aria-label="Username" aria-describedby="basic-addon1" readonly value=" {{$pedido->total}} ">
<div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
</div>
</div>


</div>




   
   
<div class="row mx-5 mt-4 " >
      <h4>Datos del internos</h4>
  </div>

   <div class="row border mx-5 py-4" style="background-color: white;">
  
    
   <div class="col-sm-6 ">


<label for="" class="col-sm-6 col-form-label">Usuario que registra</label>
<div class="input-group mb-3">

  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/external-itim2101-lineal-itim2101/25/null/external-operator-logistics-and-delivery-itim2101-lineal-itim2101.png"/></span>
  </div>
  <input type="text" id="ingresado" name="ingresado" value ="{{\Illuminate\Support\Facades\Auth::user()->name}}" class="form-control" aria-label="Username" aria-describedby="basic-addon1" readonly>
</div>
    </div>
    
    <div class="col-sm-6">
    <label for="" class="col-sm-6 col-form-label">Recepción agencia</label>
<div class="input-group mb-3">

  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1"> <img src="https://img.icons8.com/ios-filled/25/null/online-store.png"/></span>
  </div>
  <select id="agencia" name="agencia" class="form-control">
  <option value="{{$pedido->agencia}}" selected >{{$pedido->agencia}}</option>
       <option value="San Salvador">San Salvador</option>
       <option value="San Miguel">San Miguel</option>
       <option value="Santa Ana">Santa Ana</option>
       </select>
       <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
</div>





    </div>



    </div>    
   
   
    <div class="row border mx-5 py-4" style="background-color: white;">


        <div class="col-sm-6 ">


              <label for="" class="col-sm-6 col-form-label">Repartidor</label>
          <div class="input-group mb-3">

              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/external-kmg-design-detailed-outline-kmg-design/25/null/external-delivery-man-logistics-delivery-kmg-design-detailed-outline-kmg-design-2.png"/></span>
            </div>
            <select id="repartidor" name="repartidor" class="form-control">
              <option value="{{$pedido->repartidor}}" selected >{{$pedido->repartidor}}</option>
                @foreach($repartidores as $repartidor)
                <option value="{{ $repartidor->nombre }}">{{ $repartidor->nombre }}</option>
                @endforeach
     
            </select>
            <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
          </div>
        </div>
    
        <div class="col-sm-6">
            <label for="" class="col-sm-6 col-form-label">Ruta</label>
            <div class="input-group mb-3">

              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"> <img src="https://img.icons8.com/external-wanicon-lineal-wanicon/25/null/external-map-logistics-wanicon-lineal-wanicon.png"/></span>
              </div>
              <select id="ruta" name="ruta" class="form-control">
                <option value="{{$pedido->ruta}}" selected >{{$pedido->ruta}}</option>
                <option value="RUTA 1">RUTA 1</option>
                <option value="RUTA 2">RUTA 2</option>
                <option value="RUTA 3">RUTA 3</option>
                <option value="RUTA 4">RUTA 4</option>
                <option value="RUTA 5">RUTA 5</option>
              </select>
              <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
            </div>
        </div>

    </div>


    <div class="row border mx-5 py-4" style="background-color: white;">

<div class="col-sm-6 ">


<label for="" class="col-sm-6 col-form-label">Nota</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1"> <i class="fas fa-file-alt"></i> </span>
  </div>
  <input type="text" id="nota" name="nota" class="form-control" aria-describedby="basic-addon1"  value=" {{$pedido->nota}} ">
  <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
</div>
    </div>
    <div class="col-sm-6">
    <label for="" class="col-sm-8 col-form-label">Código de barra del estante</label>
<div class="input-group mb-3">

  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1"> <i class="fas fa-barcode"></i> </span>
  </div>
  <input type="text" id="estante" name="estante" class="form-control" aria-label="Username" aria-describedby="basic-addon1" >
</div>
    </div>

</div>
<div class="row border mx-5 py-4" style="background-color: white;">
  

    <label for="inputEmail3" class="col-sm-12 col-form-label">Foto del paquete</label>

    <div class="col-sm-12">
    <input type="file" id="foto" name="foto" class="form-control" tabindex="10">
    <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
    </div>
    
    <br>
</div>







<div class="row border mx-5 py-4" style="background-color: white;">
<div class="modal-footer">
        
<a href="/facturas" class="btn btn-primary">Cancelar</a> &nbsp; &nbsp;
        <button type="submit" class="btn btn-primary">Editar</button>
        </div>

        </div>


</form>


</div>
                    </div>
                </div> 
            </div>
        </div>
    </section>    
@endsection
