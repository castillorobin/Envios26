@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Agregar Comercio</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card"> 
                        <div class="card-body">

                            <h3 class="text-center">Datos de Comercio</h3>


<style>


 

</style>
<script>
function myFunction() {
  document.getElementById("myForm").reset();
}
</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script>
function myFunction() {
  document.getElementById("myForm").reset();
}

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
  
  $("#flexs").click(function() {
                     //alert($(this).val());
const tele = document.getElementById("telefono").value;
//const preci = parseFloat(document.getElementById("precio").value);						                                                    
//const envi =parseFloat($(this).val()); 
//document.getElementById("whatsapp").value = "71902023";
if(document.getElementById("flexs").checked)
{
  document.getElementById("whatsapp").value = tele;
 
}else{
  document.getElementById("whatsapp").value = ' ';
}



 });

   
});



</script>
<form action="/comercio/guardar" method="POST" id="myForm">
    @csrf
    @method('GET')
    <div class="row mx-5" >
 
      <div class="alert alert-danger" role="alert">
      <i class="fas fa-exclamation-circle"></i> Estimado usuario los campos con * son obligatorios
      </div>
    </div>
  <br>
<!-- empieza row general  -->
<div class="row border mx-5 py-4" style="background-color: white; border-radius: 10px;" >
  


  <div class="col-sm-4">
<label for="" class="col-sm-6 col-form-label">ID Comercio</label>
<div class="input-group mb-3">

  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/fluency-systems-regular/48/null/checked-identification-documents.png" width="25" /></span>
  </div>
  <input type="text" class="form-control" placeholder="{{ $uid }}" aria-label="Username" aria-describedby="basic-addon1" disabled>
</div>
</div>



 <!-- termina fila  -->



  <div class="col-sm-12">
<label for="" class="col-sm-6 col-form-label">Comercio/Tienda *</label>
<div class="input-group mb-3">

  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/25/null/gender-neutral-user--v1.png"/></span>
  </div>
  <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese nombre del comercio" aria-label="Username" aria-describedby="basic-addon1" required>
  <div class="invalid-feedback">Este campo es obligatorio.</div>
  <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
</div>
</div>




  <!-- termina fila  -->
 

  <div class="col-sm-12">
<label for="" class="col-sm-6 col-form-label">Direccion del comercio *</label>
<div class="input-group mb-3">

  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/glyph-neue/25/null/order-delivered.png"/></span>
  </div>
  <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Ingrese direccion del comercio" aria-label="Username" aria-describedby="basic-addon1" required>
  <div class="invalid-feedback">Este campo es obligatorio.</div>
      <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
</div>

</div>

  <!-- termina fila  -->
 
  <div class="col-sm-6 ">
    <label for="inputEmail3" class="col-sm-4 col-form-label">Telefono</label>
    <div class="input-group mb-3">

  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/phone--v1.png"/></span>
  </div>
  <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Ingrese telefono" aria-label="Username" aria-describedby="basic-addon1" data-inputmask="'mask': '9999-9999'">
  <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
</div>
    </div>
     
    <div class="col-sm-6">
    <label for="inputEmail3" class="col-sm-4 col-form-label">Whatsapp</label>
    <div class="input-group mb-3">

  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/whatsapp--v1.png"/></span>
  </div>
  <input type="text" id="whatsapp" name="whatsapp" class="form-control" placeholder="Ingrese whatsapp" aria-label="Username" aria-describedby="basic-addon1" data-inputmask="'mask': '9999-9999'">
  <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
</div>
<div class="form-check form-switch" style="font-size:12px; float: right; margin-top: -12px;" >
        
      Activa si el telefono es igual al whatsapp  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;  <input class="form-check-input" type="checkbox" role="switch" id="flexs" name="flexs">
  
</div>
    </div>
 <!-- termina fila  -->


  <div class="col-sm-4">
<label for="" class="col-sm-6 col-form-label">Fecha de alta</label>
<div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/upload-2--v1.png"/></span>
</div>
<input type="text" id="falta" name="falta" class="form-control" placeholder="{{date('d/m/Y')}}" aria-label="Username" aria-describedby="basic-addon1" disabled>
<div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
</div>
</div>



<div class="col-sm-4">
<label for="" class="col-sm-6 col-form-label">Fecha de baja</label>
<div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/download-2--v1.png"/></span>
</div>
<input type="date" id="fbaja" name="fbaja" class="form-control" placeholder="BAJA" aria-label="Username" aria-describedby="basic-addon1">
<div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
</div>
</div>


<div class="col-sm-4">
<label for="" class="col-sm-6 col-form-label">Tipo de comercio</label>
<div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/climbing-wall.png"/></span>
</div>
<select id="tipoven" name="tipoven" class="form-control">
       <option value="Pequeño">Pequeño</option>
       <option value="Mediano">Mediano</option>
       <option value="Grande">Grande</option>
        
       </select>
       <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
</div>
</div>
<!-- termina fila  -->

 
<div class="col-sm-8 ">
    <label for="inputEmail3" class="col-sm-4 col-form-label">Correo</label>
    <div class="input-group mb-3">

  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/metro/25/null/email.png"/></span>
  </div>
  <input type="text" id="correo" name="correo" class="form-control" placeholder="Ingrese el correo" aria-label="Username" aria-describedby="basic-addon1">
  <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
</div>
    </div>
    
    <div class="col-sm-4">
    <label for="inputEmail3" class="col-sm-8 col-form-label">Estado del comercio</label>
    <div class="input-group mb-3">

  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/whatsapp--v1.png"/></span>
  </div>
  <select id="estado" name="estado" class="form-control">
       <option value="Alta">Alta</option>
       <option value="Baja">Baja</option>
       <option value="Lista negra">Lista negra</option>
        
       </select>
       <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
</div>
    </div>
<!-- termina fila  -->

     
<div class="col-sm-8 ">
    <label for="inputEmail3" class="col-sm-4 col-form-label">Nota</label>
    <div class="input-group mb-3">

  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/metro/25/null/email.png"/></span>
  </div>
  <input type="text" id="nota" name="nota" class="form-control" placeholder="Ingrese una nota" aria-label="Username" aria-describedby="basic-addon1">
  <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
</div>
    </div>
    
    <div class="col-sm-4">
    <label for="inputEmail3" class="col-sm-8 col-form-label">Agencia de registro</label>
    <div class="input-group mb-3">

  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/whatsapp--v1.png"/></span>
  </div>
  <select id="agenr" name="agenr" class="form-control">
       <option value="San Salvador">San Salvador</option>
       <option value="San Miguel">San Miguel</option>
       <option value="Santa Ana">Santa Ana</option>
        
       </select>
       <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
</div>
    </div>
<!-- termina fila  -->

</div><!--termina row general  -->


<div class="row mx-5 mt-4 " >
      <h4>Información Bancaria</h4>
  </div>

  <div class="row border mx-5 py-4" style="background-color: white; border-radius: 10px;" >

 
  <div class="col-sm-12">
<label for="" class="col-sm-6 col-form-label">Nombre del titular de la cuenta</label>
<div class="input-group mb-3">

  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/bank-building.png"/></span>
  </div>
  <input type="text" id="titular" name="titular" class="form-control" placeholder="Ingrese el nombre del titular de la cuenta" aria-label="Username" aria-describedby="basic-addon1">
  <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
</div>

</div>
<!-- termina fila  -->


 
<div class="col-sm-6 ">
    <label for="inputEmail3" class="col-sm-6 col-form-label">Nombre del banco</label>
    <div class="input-group mb-3">

  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/money-box--v1.png"/></span>
  </div>
  <input type="text" id="banco" name="banco" class="form-control" placeholder="Ingrese el nombre del banco" aria-label="Username" aria-describedby="basic-addon1">
  <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
</div>
    </div>
    
    <div class="col-sm-6">
    <label for="inputEmail3" class="col-sm-6 col-form-label">Número de cuenta</label>
    <div class="input-group mb-3">

  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1"> <img src="https://img.icons8.com/material/24/null/100.png"/></span>
  </div>
  <input type="text" id="ncuenta" name="ncuenta" class="form-control" placeholder="Ingrese el número de cuenta" aria-label="Username" aria-describedby="basic-addon1">
  <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
</div>
    </div>
<!-- termina fila  -->



<div class="col-sm-4">
<label for="" class="col-sm-6 col-form-label">Tipo de cuenta</label>
<div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/merchant-account.png"/></span>
</div>
<select id="tcuenta" name="tcuenta" class="form-control">
<option value="Ahorros">Ahorros</option>
       <option value="Corriente">Corriente</option>
       
        
       </select>
       <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
</div>
</div>



<div class="col-sm-4 ">
<label for="" class="col-sm-6 col-form-label"># de chivo</label>
<div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/bitcoin--v1.png"/></span>
</div>
<input type="text" id="chivo" name="chivo" class="form-control" placeholder="CHIVO" aria-label="Username" aria-describedby="basic-addon1">
<div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
</div>
</div>


<div class="col-sm-4">
<label for="" class="col-sm-6 col-form-label"># de tigo money</label>
<div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/stack-of-money.png"/></span>
</div>
<input type="text" id="tmoney" name="tmoney" class="form-control" placeholder="TIGO MONEY" aria-label="Username" aria-describedby="basic-addon1">
<div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
</div>
</div>
<!-- termina fila  -->


</div><!--termina row general  -->


<div class="row mx-5 mt-4 " >
      <h4>Información Fiscal</h4>
  </div>

  <div class="row border mx-5 py-4" style="background-color: white; border-radius: 10px;" >



  <div class="col-sm-12 ">
    <label for="inputEmail3" class="col-sm-8 col-form-label">Nombre de la empresa</label>
    <div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1"> <img src="https://img.icons8.com/material/24/null/shop-department.png"/></span>
</div>
<input type="text" id="empresa" name="empresa" class="form-control" placeholder="Ingrese el nombre de la empresa o persona natural" aria-label="Username" aria-describedby="basic-addon1" >
<div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
</div>
    </div>
    
<!-- termina fila  -->



<div class="col-sm-8 ">
    <label for="inputEmail3" class="col-sm-8 col-form-label">Giro</label>
    <div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1"> <img src="https://img.icons8.com/material/24/null/shop-department.png"/></span>
</div>
<input type="text" id="giro" name="giro" class="form-control" placeholder="Ingrese el giro de la empresa" aria-label="Username" aria-describedby="basic-addon1" >
<div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
</div>
    </div>
    
    <div class="col-sm-4">
    <label for="inputEmail3" class="col-sm-8 col-form-label">Tipo de contribuyente</label>
    <div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1"> <img src="https://img.icons8.com/material/24/null/business-network.png"/></span>
</div>
<select id="agenr" name="agenr" class="form-control">
       <option value="Pequeño">Pequeño</option>
       <option value="Mediano">Mediano</option>
       <option value="Grande">Grande</option>
        
       </select>
       <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
</div>
    </div>
<!-- termina fila  -->



<div class="col-sm-4">
<label for="" class="col-sm-8 col-form-label">Número de (DUI)</label>
<div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/merchant-account.png"/></span>
</div>
<input type="text" id="dui" name="dui" class="form-control" placeholder="Ingrese número de DUI" aria-label="Username" aria-describedby="basic-addon1">
<div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
</div>
</div>



<div class="col-sm-4 ">
<label for="" class="col-sm-8 col-form-label">Número de (IVA)</label>
<div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/bitcoin--v1.png"/></span>
</div>
<input type="text" id="niva" name="niva" class="form-control" placeholder="Ingrese el NIT de la empresa" aria-label="Username" aria-describedby="basic-addon1">
<div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
</div>
</div>


<div class="col-sm-4">
<label for="" class="col-sm-10 col-form-label">Número de registro (NRC)</label>
<div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/stack-of-money.png"/></span>
</div>
<input type="text" id="nrc" name="nrc" class="form-control" placeholder="Ingrese el NRC de la empresa" aria-label="Username" aria-describedby="basic-addon1" >
<div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
</div>
</div>
<!-- termina fila  -->



<div class="col-sm-12 ">
    <label for="inputEmail3" class="col-sm-8 col-form-label">Dirección fiscal</label>
    <div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1"> <img src="https://img.icons8.com/material/24/null/shop-department.png"/></span>
</div>
<input type="text" id="empresa" name="empresa" class="form-control" placeholder="Ingrese la dirección fiscal de la empresa" aria-label="Username" aria-describedby="basic-addon1" >
<div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
</div>
    </div>
<!-- termina fila  -->

<div class="modal-footer px-4">
       
<a href="/pedido/crearpf" class="btn btn-primary">Cerrar</a>
        &nbsp; &nbsp;
        
        <a href="/pedido/comerfijo" class="btn btn-primary">Limpiar</a>
      &nbsp; &nbsp;
        <button type="submit" class="btn btn-primary" name="pfijo">Guardar y cerrar</button>
      </div>


  </div><!--termina row general  -->

<br>



</form>



   



</div>
                    </div>
                </div> 
            </div>
        </div>
    </section>    


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.3/jquery.inputmask.bundle.min.js"></script>
    <script>
  $(document).ready(function(){
  
 /* $(":input").inputmask();*/
 Inputmask().mask(document.querySelectorAll("input"));
});
</script>
@endsection

