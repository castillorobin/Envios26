@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Agregar Recolecta</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card"> 
                        <div class="card-body">
                            
                            
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


 
 


</script>


      <form action="/recolecta" method="POST" id="myForm">
    @csrf

    <div class="row mx-5" >
    
      <div class="alert alert-danger" role="alert">
      <i class="fas fa-exclamation-circle"></i> Estimado usuario los campos con * son obligatorios
      </div>
    </div>
  <br>
<!-- empieza row general  -->
<div class="row border mx-5 py-4" style="background-color: white;" >
  

    <div class="col-sm-10">
        <label for="" class="col-sm-4 col-form-label">Comercio / tienda *</label>
        <div class="input-group mb-3">

                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"> <i class="fas fa-user"></i> </span>
                </div>
                <select id="nombre" name="nombre" class="form-control" tabindex="1" required>
                    <option >Sin asignar</option>
       
                    @for($i=0;  $i< count($vendedores); $i++ )
                    <option value="{{$i}}">{{ $vendedores[$i]->nombre }} </option>
       
                        @endfor
                </select>
      
                <div class="invalid-feedback">Este campo es obligatorio.</div>

                    <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
        </div>
                @for($i=0;  $i< count($vendedores); $i++ )
       
                    <input hidden id="direc{{$i}}" value="{{ $vendedores[$i]->direccion }} ">
                <input hidden id="tele{{$i}}" value="{{ $vendedores[$i]->telefono }} ">
                <input hidden id="what{{$i}}" value="{{ $vendedores[$i]->whatsapp }} ">
                <input hidden id="nom2{{$i}}" value="{{ $vendedores[$i]->nombre }} ">
       
       
                @endfor
  
    </div>

<div class="col-sm-2 pt-5" >
      <a href="/pedido/desdeenvio">+ Crear</a>
  </div>
  <!-- termina fila  -->

  
  <input hidden type="text" id="nombre2" name="nombre2" value=" ">
<div class="col-sm-12 ">
    <label for="inputEmail3" class="col-sm-6 col-form-label">Dirección de recolecta</label>
    <div class="input-group mb-3">

  <div class="input-group-prepend">
  <span class="input-group-text" id="basic-addon1"> <i class="fas fa-map-marker-alt"></i> </span>
  </div>
  <input type="text" class="form-control" id="direccion" name="direccion" aria-label="Username" aria-describedby="basic-addon1" tabindex="2" >
  <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>
</div>
    </div>
     
    <div class="col-sm-6">
    <label for="inputEmail3" class="col-sm-6 col-form-label">Teléfono</label>
      <div class="input-group mb-3">

        <div class="input-group-prepend">
         <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone-square-alt"></i> </span>
        </div>
          <input type="text" class="form-control" name="telefono" id="telefono" aria-label="Username" aria-describedby="basic-addon1" tabindex="3" data-inputmask="'mask': '9999-9999'">
        <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>

</div>
    </div>

    <div class="col-sm-6">
    <label for="inputEmail3" class="col-sm-6 col-form-label">Whatsapp</label>
      <div class="input-group mb-3">

        <div class="input-group-prepend">
         <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone-square-alt"></i> </span>
        </div>
          <input type="text" class="form-control" name="whatsapp" id="whatsapp" aria-label="Username" aria-describedby="basic-addon1" tabindex="3" data-inputmask="'mask': '9999-9999'">
        <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>

</div>
    </div>
  <!-- termina fila  -->

  
  
    
<div class="col-sm-6">
<label for="" class="col-sm-4 col-form-label">Fecha de recolecta</label>
<div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1"> <i class="fas fa-dolly"></i> </span>
</div>
<input type="date" class="form-control" name="fechare" placeholder="" value="{{ date('Y-m-d') }}" aria-label="Username" aria-describedby="basic-addon1" tabindex="4">
<div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>
</div>
</div>


<div class="col-sm-6">
<label for="" class="col-sm-4 col-form-label">Fecha de entrega</label>
<div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1"> <i class="fas fa-archive"></i> </span>
</div>
<input type="date" class="form-control" name="fechaen" placeholder="" aria-label="Username" aria-describedby="basic-addon1" tabindex="5">
<div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>
</div>
</div>
<!-- termina fila  -->


    
<div class="col-sm-6">
<label for="" class="col-sm-4 col-form-label">Repartidor</label>
<div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1"> <i class="fas fa-dolly"></i> </span>
</div>
<select id="repartidor" name="repartidor" class="form-control" tabindex="6">
<option >-Seleccionar repartidor-</option>
       @foreach($repartidores as $repartidor)
       <option value="{{ $repartidor->nombre }}">{{ $repartidor->nombre }}</option>
       @endforeach
     
       </select>

       <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>
</div>
</div>


<div class="col-sm-6">
<label for="" class="col-sm-4 col-form-label">Estado</label>
<div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1"> <i class="fas fa-archive"></i> </span>
</div>
<select id="estado" name="estado" class="form-control" tabindex="7">
       <option value="Creada">Creada</option>
       <option value="Recolectada">Recolectada</option>
       <option value="Reprogramada">Reprogramada</option>
        
       <option value="No recolectada">No recolectada</option>
       </select>
       <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>
</div>
</div>
 <!-- termina fila  -->


    
<div class="col-sm-8">
<label for="" class="col-sm-4 col-form-label">Nota</label>
<div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1"> <i class="fas fa-book"></i> </span>
</div>
<input type="text" class="form-control" name="nota" placeholder="Ingrese nota, indicación, etc." aria-label="Username" aria-describedby="basic-addon1" tabindex="8">
<div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>
</div>
</div>
 

<div class="col-sm-4">
<label for="" class="col-sm-4 col-form-label">Agencia</label>
<div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1"> <i class="fas fa-book"></i> </span>
</div>
<select id="agencia" name="agencia" class="form-control" tabindex="9">
       <option value="San Salvador">San Salvador</option>
       <option value="San Miguel">San Miguel</option>
       <option value="Santa Ana">Santa Ana</option>
       </select>
       <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>
</div>
</div>
  <!-- termina fila  -->

  <div class="row">
     
<br>
<div class="modal-footer" >
<a href="/recolecta" class="btn btn-primary">Cancelar</a>
        &nbsp; &nbsp;

        <a href="/recolecta/create" class="btn btn-primary">Limpiar</a>
      &nbsp; &nbsp;
<button type="submit" class="btn btn-primary" tabindex="10">Guardar</button>

</div>
  </div><!-- termina fila  -->



  </div><!--termina row general  -->


 



<br>
 



</form>

<!-- JQUERY-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- INPUT MASK-->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.3/jquery.inputmask.bundle.min.js"></script>

<script>
  $(document).ready(function(){
  
 /* $(":input").inputmask();*/
 Inputmask().mask(document.querySelectorAll("input"));
});
</script>
<script>
  $("#nombre").change(function() {
       												 //alert($(this).val());
          var id=$(this).val();       
         //var direc = document.getElementById("dire").textContent;
         var first=$('#direc'+id).val();
         var tel=$('#tele'+id).val();
         var wha=$('#what'+id).val();
         var nom=$('#nom2'+id).val();
          //var direc=$('#dire').text();
          //const direc = 'HOla direci';

          //document.getElementById("direccion").value = first;
          document.getElementById("direccion").value = first;
          document.getElementById("telefono").value = tel;
          document.getElementById("whatsapp").value = wha;
          document.getElementById("nombre2").value = nom;
          //for(let i=0; i< '{{ count($vendedores) }}'; i++){
            //if (i == id){
              
            //}
         // }
          /*
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
*/
    				});
</script>






                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>    
@endsection

