@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Comercio</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card"> 
                        <div class="card-body">

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
    
    <form action="/vendedores/{{$vendedor->id}}" method="POST">
    @csrf
    @method('PUT')   
    
   
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
  <input type="text" id="nombre" name="nombre" class="form-control" tabindex="1"  value=" {{$vendedor->nombre }} " required>
  <div class="invalid-feedback">Este campo es obligatorio.</div>
  <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp; Editado con Éxito</div> 
</div>
</div>


<div class="col-sm-12">
<label for="" class="col-sm-6 col-form-label">Direccion del comercio</label>
<div class="input-group mb-3">

  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/glyph-neue/25/null/order-delivered.png"/></span>
  </div>
  <input type="text" id="dire" name="dire" class="form-control" tabindex="2" value=" {{$vendedor->direccion }} ">

      <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
</div>
</div>


<div class="col-sm-6 ">
    <label for="inputEmail3" class="col-sm-4 col-form-label">Telefono</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/phone--v1.png"/></span>
  </div>
  <input type="text" id="tele" name="tele" class="form-control" tabindex="3" value=" {{$vendedor->telefono }} ">
 

      <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
      
</div>
    </div>
    
    <div class="col-sm-6">
    <label for="inputEmail3" class="col-sm-4 col-form-label">Whatsapp</label>
    <div class="input-group mb-3">

  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/whatsapp--v1.png"/></span>
  </div>
  <input type="text" id="what" name="what" class="form-control" tabindex="4" value=" {{$vendedor->whatsapp }} ">
  
      <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
</div>

    </div>
  


  <div class="col-sm-4">
<label for="" class="col-sm-6 col-form-label">Fecha de alta</label>
<div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/upload-2--v1.png"/></span>
</div>
<input type="text" id="falta" name="falta" class="form-control" tabindex="5" value=" {{  date('d/m/Y', strtotime($vendedor->created_at))  }} ">
<div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
</div>
</div>



<div class="col-sm-4">
<label for="" class="col-sm-6 col-form-label">Fecha de baja</label>
<div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/download-2--v1.png"/></span>
</div>
<input type="text" id="fbaja" name="fbaja" class="form-control" value=" {{  date('d/m/Y', strtotime($vendedor->fbaja))  }}" aria-label="Username" aria-describedby="basic-addon1" tabindex="6">
<div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
</div>
</div>


<div class="col-sm-4">
<label for="" class="col-sm-6 col-form-label">Tipo de comercio</label>
<div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/climbing-wall.png"/></span>
</div>
<select id="tvende" name="tvende" class="form-control" tabindex="7">
        <option value="{{$vendedor->tipovende }}" selected >{{$vendedor->tipovende }}</option>
       <option value="Pequeño">Pequeño</option>
       <option value="Mediano">Mediano</option>
       <option value="Grande">Grande</option>
       
       </select>
       <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
</div>
</div>





<div class="col-sm-8 ">
    <label for="inputEmail3" class="col-sm-4 col-form-label">Correo</label>
    <div class="input-group mb-3">

  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/metro/25/null/email.png"/></span>
  </div>
  <input type="text" id="correo" name="correo" class="form-control" tabindex="8" value=" {{$vendedor->correo }} ">
  <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
</div>
    </div>
    
    <div class="col-sm-4">
    <label for="inputEmail3" class="col-sm-8 col-form-label">Estado del comercio</label>
    <div class="input-group mb-3">

  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/whatsapp--v1.png"/></span>
  </div>
 
  <select id="estado" name="estado" class="form-control" tabindex="9">
        <option value="{{$vendedor->estado }}" selected >{{$vendedor->estado }}</option>
        <option value="Alta">Alta</option>
       <option value="Baja">Baja</option>
       <option value="Lista negra">Lista negra</option>
        
       </select>
       <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
</div>
    </div>


    
    <div class="col-sm-8 ">
    <label for="inputEmail3" class="col-sm-4 col-form-label">Nota</label>
    <div class="input-group mb-3">

  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1"> <i class="fas fa-align-left"></i></span>
  </div>
  <input type="text" id="nota" name="nota" class="form-control" tabindex="10" value=" {{$vendedor->nota }} ">
  <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
</div>
    </div>
    
    <div class="col-sm-4">
    <label for="inputEmail3" class="col-sm-8 col-form-label">Agencia de registro</label>
    <div class="input-group mb-3">

  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">  <i class="fas fa-building"></i></span>
  </div>
  <select id="agen" name="agen" class="form-control" tabindex="11">
        <option value="{{$vendedor->agencia }}" selected >{{$vendedor->agencia }}</option>
       <option value="San Salvador">San Salvador</option>
       <option value="San Miguel">San Miguel</option>
       <option value="Santa Ana">Santa Ana</option>
        
       </select>
       <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
</div>
    </div>
</div><!-- termina fila  -->


<div class="row mx-5 mt-4 " >
      <h4>Información Bancaria</h4>
  </div>


  <div class="row border mx-5 py-4" style="background-color: white;" >
    

    
  <div class="col-sm-12">
<label for="" class="col-sm-6 col-form-label">Nombre del titular de la cuenta</label>
<div class="input-group mb-3">

  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/bank-building.png"/></span>
  </div>
  <input type="text" id="titular" name="titular" class="form-control" tabindex="6" value=" {{$vendedor->titular }} " tabindex="12">
  <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
</div>

</div>


<div class="col-sm-6 ">
    <label for="inputEmail3" class="col-sm-6 col-form-label">Nombre del banco</label>
    <div class="input-group mb-3">

  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/money-box--v1.png"/></span>
  </div>
  <input type="text" id="banco" name="banco" class="form-control" tabindex="13" value=" {{$vendedor->banco }} ">
  <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
</div>
    </div>
    
    <div class="col-sm-6">
    <label for="inputEmail3" class="col-sm-6 col-form-label">Número de cuenta</label>
    <div class="input-group mb-3">

  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1"> <img src="https://img.icons8.com/material/24/null/100.png"/></span>
  </div>
  <input type="text" id="cuenta" name="cuenta" class="form-control" tabindex="7" value=" {{$vendedor->cuenta }} " tabindex="14">
  <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
</div>
    </div>


   
<div class="col-sm-4">
<label for="" class="col-sm-6 col-form-label">Tipo de cuenta</label>
<div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/merchant-account.png"/></span>
</div>
<select id="tcuenta" name="tcuenta" class="form-control" tabindex="15">
<option value="{{$vendedor->tcuenta }}" selected >{{$vendedor->tcuenta }}</option>
<option value="Ahorros">Ahorros</option>


       <option value="Corriente">Corriente</option>
       
        
       </select>
       <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
</div>
</div>



<div class="col-sm-4 ">
<label for="" class="col-sm-6 col-form-label"># de chivo</label>
<div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/bitcoin--v1.png"/></span>
</div>
<input type="text" id="chivo" name="chivo" class="form-control" tabindex="16" value=" {{$vendedor->chivo }} ">
<div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
</div>
</div>


<div class="col-sm-4">
<label for="" class="col-sm-6 col-form-label"># de tigo money</label>
<div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/stack-of-money.png"/></span>
</div>
<input type="text" id="money" name="money" class="form-control" tabindex="17" value=" {{$vendedor->tmoney }} ">
<div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
</div>
</div>



</div>


   
<div class="row mx-5 mt-4 " >
      <h4>Información Fiscal</h4>
  </div>


   
   
  <div class="row border mx-5 py-4" style="background-color: white;" >
   
    
    
  <div class="col-sm-12 ">
    <label for="inputEmail3" class="col-sm-8 col-form-label">Nombre de la empresa</label>
    <div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1"> <img src="https://img.icons8.com/material/24/null/shop-department.png"/></span>
</div>
<input type="text" id="empresa" name="empresa" class="form-control" tabindex="18" value=" {{$vendedor->empresa }} ">
<div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
</div>
    </div>
    


    <div class="col-sm-8 ">
    <label for="inputEmail3" class="col-sm-8 col-form-label">Giro</label>
    <div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1"> <img src="https://img.icons8.com/material/24/null/shop-department.png"/></span>
</div>
<input type="text" id="giro" name="giro" class="form-control" tabindex="19" value=" {{$vendedor->giro }} ">
<div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
</div>
    </div>
    
    <div class="col-sm-4">
    <label for="inputEmail3" class="col-sm-8 col-form-label">Tipo de contribuyente</label>
    <div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1"> <img src="https://img.icons8.com/material/24/null/business-network.png"/></span>
</div>
<select id="agenr" name="agenr" class="form-control" tabindex="20">
       <option value="Pequeño">Pequeño</option>
       <option value="Mediano">Mediano</option>
       <option value="Grande">Grande</option>
        
       </select>
       <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
</div>
    </div>



<div class="col-sm-4"> 
<label for="" class="col-sm-8 col-form-label">Número de (DUI)</label>
<div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/merchant-account.png"/></span>
</div>
<input type="text" id="dui" name="dui" class="form-control" tabindex="21" value=" {{$vendedor->dui }} ">
<div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
</div>
</div>



<div class="col-sm-4 ">
<label for="" class="col-sm-8 col-form-label">Número de (IVA)</label>
<div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/bitcoin--v1.png"/></span>
</div>
<input type="text" id="iva" name="iva" class="form-control" tabindex="22" value=" {{$vendedor->niva }} ">
<div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
</div>
</div> 


<div class="col-sm-4">
<label for="" class="col-sm-10 col-form-label">Número de registro (NRC)</label>
<div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">  <img src="https://img.icons8.com/material/24/null/stack-of-money.png"/></span>
</div>
<input type="text" id="nrc" name="nrc" class="form-control" tabindex="23" value=" {{$vendedor->nrc }} ">
<div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
</div>
</div>


<div class="col-sm-12 ">
    <label for="inputEmail3" class="col-sm-8 col-form-label">Dirección fiscal</label>
    <div class="input-group mb-3">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1"> <img src="https://img.icons8.com/material/24/null/shop-department.png"/></span>
</div>
<input type="text" id="dfiscal" name="dfiscal" class="form-control" tabindex="24" value="  ">
<div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Editado con Éxito</div> 
</div>
    </div>


    <div class="modal-footer px-4">
<a href="/vendedores" class="btn btn-primary">Cancelar</a>
        
      &nbsp; &nbsp;
        <button type="submit" class="btn btn-primary">Editar</button>
      </div>

   </div> 


</div>




    
   

    <br>
   





   </div>

</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.3/jquery.inputmask.bundle.min.js"></script>

                            
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>    
@endsection

