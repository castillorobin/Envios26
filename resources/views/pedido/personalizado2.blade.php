
@extends('layouts.app')

@section('content')
{{date_default_timezone_set('America/El_Salvador') }}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>


<script>

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


    function redireccionarPagina(){
    window.setTimeout( abrirURL, 2000 ); // 3 segundos
};
    
function abrirURL(){
    //Abrir URL que necesites
    //window.location = "http://127.0.0.1:8000/pedidos";
    window.location = "https://appmeloexpress.com/pedido/crearp";
};
</script>



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

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>  
jQuery(document).ready(function($){
    $(document).ready(function() {
        $('.mi-selector').select2({
          maximumSelectionLength: 1
        });
        $('.mi-selector1').select2({
          maximumSelectionLength: 1
        });
        
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

<!--  
Inicia nuevo formulario
-->

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Crear Envio Personalizado</h3>
    </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card"> 
                        



<form action="/pedidos" method="POST" id="myForm" enctype="multipart/form-data" >
   @csrf

       
  <div class="row mx-1" >
   
      <div class="alert alert-danger mx-3 mt-4" role="alert">
      <i class="fas fa-exclamation-circle"></i> Estimado usuario los campos con * son obligatorios
      </div>
  </div>
  
  
    <div class="row mx-3 border py-1" style="background-color: white; border-radius: 10px;" >
    <!--  
Parte 1
-->
        <div class="col-5 p-2" style="width=100%;">
        <div class="row">
            <div class="col-10 ">
            <input type="text"  hidden >
                <label for="" class="col-10 col-form-label">Comercio / Tienda *</label>
      
                <select id="comer" name="comer" class="js-states form-control mi-selector1"  autofocus tabindex="1" required multiple="multiple" >
                
     
                @foreach($vendedores as $vendedor)
                <option value="{{ $vendedor->nombre }}">{{ $vendedor->nombre }}</option>
                @endforeach
                </select>
                
                <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>  
            </div>
            <br>








            <div class="col-2 pt-4" style="display: flex; align-items: center;" >
                 <a href="/pedido/comerperso/">+ Crear</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12 ">
            <label for="inputEmail3" class="col-6 col-form-label">Destinatario *</label>
            <input type="text" id="desti" name="desti" class="form-control" tabindex="2" placeholder="Ingrese el nombre del destinatario" required>
            <div class="invalid-feedback">Este campo es obligatorio.</div>
            <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>      
            </div>
        </div>

        <div class="row">
            <div class="col-8">
              <label for="" class="col-12 col-form-label">Direccion *</label>
            <div class="input-group">

            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/glyph-neue/25/null/order-delivered.png"/></span>
            </div>
                <input type="text" maxlength="64" id="direccion" name="direccion" class="form-control" placeholder="Ingrese la dirección de entrega del destinatario" aria-label="Username" aria-describedby="basic-addon1" tabindex="3" required>
                <div class="invalid-feedback">Este campo es obligatorio.</div>
                <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>      
            </div>
            </div>

            <div class="col-4">
              <label for="inputEmail3" class="col-6 col-form-label">Telefono</label>
               <input type="text" id="telefono" name="telefono" class="form-control" tabindex="4" aria-describedby="basic-addon1" data-inputmask="'mask': '9999-9999'">
     
                <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>    
            </div>

        </div>
        

        
        <div class="row">
        <div class="col-4">
        <label for="" class="col-12 col-form-label">Cobro del envio</label>
        <div class="input-group ">

          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/cheap-2.png"/></span>
          </div>
          <select id="cenvio" name="cenvio" class="form-control" tabindex="5">
          <option value="Pendiente">Pendiente</option>
          <option value="Pagado">Pagado</option>
          </select>
          <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>  
        </div>
      </div>

            <div class="col-4 ">
            <label for="" class="col-12 col-form-label">Repartidor</label>
            <div class="input-group">

          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/external-kmg-design-detailed-outline-kmg-design/25/null/external-delivery-man-logistics-delivery-kmg-design-detailed-outline-kmg-design-2.png"/></span>
          </div>
          <select id="repartidor" name="repartidor" class="form-control mi-selector" tabindex="6" multiple="multiple">
            <option value="">-Sin asignar-</option>
            @foreach($repartidores as $repartidor)
            <option value="{{ $repartidor->nombre }}">{{ $repartidor->nombre }}</option>
            @endforeach
          </select>
          <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>  
            </div>
            </div>
    
            <div class="col-4">
                <label for="" class="col-12 col-form-label">Ruta</label>
            <div class="input-group">

              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"> <img src="https://img.icons8.com/external-wanicon-lineal-wanicon/25/null/external-map-logistics-wanicon-lineal-wanicon.png"/></span>
              </div>
                <select id="ruta" name="ruta" class="form-control mi-selector" tabindex="7" multiple="multiple"> 
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


        <div class="row">
            <div class="col-4">
                <label for="" class="col-12 col-form-label">Precio del paquete</label>
    
             <div class="input-group">

          <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/cheap-2.png"/></span>
          </div>
           <input type="text" id="precio" name="precio" class="form-control" placeholder="Precio"  value="0" tabindex="8">
              <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>  
            </div>
            </div>

            <div class="col-4">
                <label for="" class="col-12 col-form-label">Precio del envio</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/cheap-2.png"/></span>
              </div>
                <input type="text" id="envio" name="envio" class="form-control" placeholder="Envio" aria-label="Username" value="0" tabindex="9">
                <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>  
          </div> 
            </div>


            <div class="col-4">
              <label for="" class="col-12 col-form-label">Total a cobrar</label>
            <div class="input-group">

              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/cheap-2.png"/></span>
              </div>
            <input type="text" id="total" name="total" class="form-control" aria-label="Username" aria-describedby="basic-addon1" readonly>
          </div>
            </div>

        </div>

      





    </div>
<!--  
Parte 2
-->
        <div class="col-5" style="background-color:#ffffff; width=100%;">
            
            <div class="row">
                
                    <div class="col-6">
                        <label for="" class="col col-form-label">Tipo de servicio</label>
                    <div class="input-group">

                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/online-support.png"/></span>
                        </div>
                        <select id="servicio" name="servicio" class="form-control" tabindex="9">
     
                            <option option value="Entrega">Entrega</option>
                            <option value="Entrega y recolecta">Entrega y recolecta</option>
  
                        </select>
                        <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
                    </div>
                    </div>
     
                <div class="col-6 ">
                    <label for="" class="col col-form-label">Tipo de envio</label>
                        <div class="input-group">

                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/external-kiranshastry-solid-kiranshastry/25/null/external-delivery-logistic-delivery-kiranshastry-solid-kiranshastry.png"/></span>
                         </div>
                        <select id="tenvio" name="tenvio" class="form-control" tabindex="10">
      
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

            <div class="row">

                <div class="col-6 ">
                <label for="" class="col-sm-12 col-form-label">Fecha de creacion</label>

                <div class="input-group ">
                 <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/tear-off-calendar.png"/></span>
                    </div> 
           
                    <input type="text" class="form-control" value="{{ date('d/m/Y h:i:s') }}" aria-label="Username" aria-describedby="basic-addon1" readonly>
                        <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>   
                </div>
        
                    </div>
    
                     <div class="col-sm-6">
                    <label for="" class="col-sm-12 col-form-label">Fecha de entrega *</label>
                        <div class="input-group ">

                     <div class="input-group-prepend">
                     <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/tear-off-calendar.png"/></span>
                     </div>
                     <input type="date" id="fentrega" name="fentrega" tabindex="11" class="form-control" value="{{ now()->Format('Y-m-d') }}" aria-label="Username" aria-describedby="basic-addon1" required>
                     <div class="invalid-feedback">Este campo es obligatorio.</div> 
                    <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>                                       
                    </div>

                    </div>
            </div>

            <div class="row">
                        
                    <div class="col-6">
                    <label for="" class="col-12 col-form-label">Estado del envio</label>
                <div class="input-group">

                    <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/deliver-food.png"/></span>
                </div>
                    <select id="estado" name="estado" class="form-control" tabindex="12">
                    <option value="Entregado">Entregado</option>
                    <option value="Creado" >Creado</option>
                <option value="En ruta">En ruta</option>
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


                 <div class="col-6">
                <label for="" class="col-12 col-form-label">Estado del pago</label>
                <div class="input-group">

                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/ios-filled/25/null/cash-in-hand.png"/></span>
                    </div>
                    <select id="pagado" name="pagado" class="form-control" tabindex="13">
                    <option value="Por pagar">Por pagar</option>
                    <option value="Pagado">Pagado</option>
                    <option value="Trans. a la empresa">Trans. a la empresa</option>
                    <option value="Trans. al comercio">Trans. al comercio</option>
            
                      </select>
                        <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>  
                    </div>
                    </div>
            </div>

            <div class="row">
            <div class="col-6 ">
      <label for="" class="col-12 col-form-label">Usuario que registra</label>
      <div class="input-group">

        <div class="input-group-prepend">
         <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/external-itim2101-lineal-itim2101/25/null/external-operator-logistics-and-delivery-itim2101-lineal-itim2101.png"/></span>
        </div>
        <input type="text" id="ingresado" name="ingresado" value ="{{\Illuminate\Support\Facades\Auth::user()->name}}" class="form-control" aria-label="Username" aria-describedby="basic-addon1" readonly>
        
        </div>
        
    </div>
    
    <div class="col-sm-6">
      <label for="" class="col-sm-12 col-form-label">Agencia</label>
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

        <div class="row">
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
        <label for="" class="col-sm-12 col-form-label">Caja o estante</label>
        <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"> <i class="fas fa-barcode"></i> </span>
        </div>
        <input type="text" id="estante" name="estante" class="form-control" placeholder="..." aria-label="Username" aria-describedby="basic-addon1" tabindex="18">
        <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>  
        </div>
      </div>
        </div>


        


        </div>

 <!--  
Parte 3
-->
        <div class="col-2 p-1 m-0" style="width=100%; ">
        <div id="flotante">
            <div id="my_camera"  ></div>
                <br/>
                <input type="button" value="Tomar foto" onClick="take_snapshot()" class="btn-success " style="margin-left: 100px;">
                <input type="hidden" name="foto" class="image-tag">
            </div>

            <div id="flotante2">
                <div id="results">Esperando foto...</div>
            </div>


            
        


          </div>

          <div class="row mt-5 ml-2 mb-2" >
          <div class="col-12" style="float:right;" >
          <a href="/pedidos" class="btn btn-primary" >Cancelar</a>
          &nbsp; &nbsp;
          <!--
        <input type="button" class="btn btn-primary" onclick="myFunction()" value="Limpiar">
  -->
  <a href="/pedido/crearp" class="btn btn-primary" >Limpiar</a>
        &nbsp; &nbsp;
        <!--   <button type="submit" name="personali" class="btn btn-primary" tabindex="19">Guardar</button> &nbsp; &nbsp;-->
          <a href="/pedidos/imprimire" onclick="redireccionarPagina()"  ><button type="submit" name="impri" class="btn btn-primary" >Guardar</button></a>
          </div>

          </div>
      

    </div>

    



    </form>

</div>
</div>
</div>
</div>
</div>




<!--  
Terminad nuevo formulario
-->




                                        

   

   



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
        width: 230,
        height: 200,
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
