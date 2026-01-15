@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Agregar Empleado</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card"> 
                        <div class="card-body">

                            <h3 class="text-center">Datos de Empleado</h3>

                            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
  body {
  font-family: 'Roboto', sans-serif;
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


</style>
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

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





</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<form action="/repartidores" method="POST" id="myForm" enctype="multipart/form-data">
    @csrf

<div class="row mx-5" >
   
      <div class="alert alert-danger" role="alert">
      <i class="fas fa-exclamation-circle"></i> Estimado usuario los campos con * son obligatorios
      </div>
    </div>
  <br>
 
  
  <div class="row mx-5" >
    <h4>Datos del Empleado</h4>
    </div>
<!-- empieza row general  -->
<div class="row border mx-5 py-4" style="background-color: white;" >
  

<div class="col-12">
                  
                  {{-- Input de Nombre  --}}
                  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 col-form-label">Nombre del empleado *</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-user"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" tabindex="1" required>  
                      <div class="invalid-feedback">Este campo es obligatorio.</div>
      <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
                    </div>
                  </div>
      
                      </div>
<!-- termina fila  -->

 
<div class="col-6">
                  {{-- Input de Direccion  --}}
            <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 col-form-label">Direccion *</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fa-sharp fa-solid fa-house"></i>
                  </span>
                </div>
                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion" tabindex="2" required>
                <div class="invalid-feedback">Este campo es obligatorio.</div>
      <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
              </div>
            </div> 
            </div>
            <div class="col-6">
  
  {{-- Input de Telefono --}}
  <div class="form-group">
  <label for="inputEmail3" class="col-sm-4 col-form-label">Telefono*</label>
   <div class="input-group">
     <div class="input-group-prepend">
       <span class="input-group-text">
         <i class="fa-sharp fa-solid fa-phone"></i>
       </span>
     </div>
     <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono" maxlength="9" tabindex="3" data-inputmask="'mask': '9999-9999'" required>
     <div class="invalid-feedback">Este campo es obligatorio.</div>
      <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
   </div>
 </div>
     </div>
<!-- termina fila  -->
 

<div class="col-4 ">
               {{-- Input de dui  --}}
               <div class="form-group">
               <label for="inputEmail3" class="col-sm-8 col-form-label">Correo Electronico</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa-solid fa-id-card"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" id="correo" name="correo" placeholder="E-mail" tabindex="4" >
                  
      <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
                </div>
              </div>
  
              </div>
  
<div class="col-4 ">
               {{-- Input de dui  --}}
               <div class="form-group">
               <label for="inputEmail3" class="col-sm-8 col-form-label">Numero de DUI *</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa-solid fa-id-card"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" id="dui" name="dui" placeholder="DUI" tabindex="5" data-inputmask="'mask': '99999999-9'" required>
                  <div class="invalid-feedback">Este campo es obligatorio.</div>
      <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
                </div>
              </div>
  
              </div>
  
              <div class="col-4">
        {{-- Input de tipo de NIT  --}}
                <div class="form-group">
                <label for="inputEmail3" class="col-sm-8 col-form-label">Numero de NIT *</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa-regular fa-id-card"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control " id="nit" name="nit" placeholder="NIT" tabindex="6" data-inputmask="'mask': '9999-999999-999-9'" required>
                    <div class="invalid-feedback">Este campo es obligatorio.</div>
      <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
                  </div>
                </div>
  
              </div>
<!-- termina fila  -->



<div class="col-6">
  
  {{-- Input de tipo de contrato  --}}
  <div class="form-group">
  <label for="inputEmail3" class="col-sm-4 col-form-label">Tipo de contrato</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">
          <i class="fa-solid fa-building"></i>
        </span>
      </div>
      <input type="text" class="form-control " id="tipo_contrato" name="tipo_contrato" placeholder="tipo de contrato:" tabindex="7">
      <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
    </div>
  </div> 
   {{--FIN Input de tipo de contrato  --}}
  </div>

  <div class="col-6">
  {{-- Input de agencia  --}}
  <label for="inputEmail3" class="col-sm-4 col-form-label">Agencia</label>
  <div class="input-group">
  <div class="input-group-prepend">
        <span class="input-group-text">
          <i class="fa-solid fa-building"></i>
        </span>
      </div>
    <select class="form-select form-control" id="agencia" name="agencia" tabindex="8">
      <option selected>Sin asignar</option>
      <option value="San Salvador">San Salvador</option>
      <option value="San Miguel">San Miguel</option>
      <option value="Santa Ana">Santa Ana</option>
    </select>
    <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
  </div>
  
  {{-- FIN Input de agencia  --}}
  </div>

<!-- termina fila  -->


<br>
<div class="col-4">{{-- INICIO COL  --}}

{{-- Input de numero de seguro  --}}
<div class="form-group">
<label for="inputEmail3" class="col-sm-4 col-form-label">Nº de ISSS</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text">
        <i class="fa-regular fa-id-card"></i>
      </span>
    </div>
    <input type="text" class="form-control" id="num_seguro" name="num_seguro" placeholder="Numero de Seguro" tabindex="9">
    <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
  </div>
</div>

      
    </div>{{-- FIN COL  --}}

    <div class="col-4">{{-- INICIO COL  --}}

{{-- Input de numero de AFP  --}}
<div class="form-group">
<label for="inputEmail3" class="col-sm-4 col-form-label">Nº de AFP</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text">
        <i class="fa-solid fa-id-card-clip"></i>
      </span>
    </div>
    <input type="text" class="form-control " id="num_afp" name="num_afp" placeholder="Numero de AFP:" tabindex="10">
    <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
  </div>
</div>
            
          </div>{{-- FIN COL  --}}


          <div class="col-4">{{-- INICIO COL  --}}

        {{-- Input de numero de Cargo  --}}
<div class="form-group">
<label for="inputEmail3" class="col-sm-4 col-form-label">Cargo *</label>
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text">
<i class="fa-sharp fa-solid fa-house"></i>
</span>
</div>
<select class="form-select form-control " id="cargo" name="cargo" tabindex="11" required>
    <option selected>Sin Asignar</option>
    <option value="Ceo">Ceo</option>
    <option value="Gerente general">Gerente General</option>
    <option value="Gerente">Gerente</option>
    <option value="Supervisor">Supervisor</option>
    <option value="Repartidor">Repartidor</option>
    <option value="Auxiliar">Auxiliar</option>
    <option value="Cajero">Cajero</option>
    <option value="Atencion al cliente">Atencion al cliente</option>
    <option value="Digitador">Digitador</option>
    <option value="Bodeguero">Bodeguero</option>
    <option value="Oficios Varios">Oficios varios</option>
    <option value="Seguridad">Seguridad</option>
    <option value="Jefe de almacén">Jefe de almacén</option>
    <option value="Operario">Operario</option>
    
  </select>
  <div class="invalid-feedback">Este campo es obligatorio.</div>
      <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div>   

</div>
</div>
                        
                      </div>{{-- FIN COL  --}}

<!-- termina fila  -->


<br>
<div class="col-4">{{-- INICIO COL  --}}
          {{-- Input de  Fecha de alta  --}}
          <div class="form-group">
          <label for="inputEmail3" class="col-sm-6 col-form-label">Fecha de Alta</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fa-solid fa-calendar-check"></i>
                  &nbsp;&nbsp;&nbsp; Fecha de Alta
                </span>
              </div>
              <input  class="form-control " id="fecha_de_alta" value="{{ date('Y-m-d') }}" name="fecha_de_alta" type="date" tabindex="12"/>
                      <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
            </div>
          </div>
                              
                            </div>{{-- FIN COL  --}}



                            <div class="col-4">{{-- INICIO COL  --}}

                      {{-- Input de Salario   --}}
                      <div class="form-group">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Salario</label>
                        <div class="input-group">

                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="fa-regular fa-money-bill-1"></i>
                            </span>
                          </div>
                          <input type="text" class="form-control"
                                 id="salario" name="salario" placeholder="Salario" tabindex="13">
                                 <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
                                </div>
                      </div>
                            </div>{{-- FIN COL  --}}


                            <div class="col-4">{{-- INICIO COL  --}}
                    
          {{-- Input de  Fecha de baja  --}}
          <div class="form-group">
          <label for="inputEmail3" class="col-sm-6 col-form-label">Fecha de baja</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fa-solid fa-calendar-days"> </i>
                  &nbsp;&nbsp;&nbsp;Fecha de Baja
                </span>
              </div>
              <input class="form-control "
                     id="fecha_de_baja" name="fecha_de_baja" type="date" tabindex="14"/>
                     <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
            </div>
          </div>

                              </div>{{-- FIN COL  --}}

<!-- termina fila  -->


<br>
<div class="col-12">{{-- INICIO COL  --}}
              
              {{-- Input de numero de notas --}}
              <div class="form-group">
              <label for="inputEmail3" class="col-sm-6 col-form-label">Nota</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa-regular fa-note-sticky"></i>
                    </span>
                  </div>
                  <textarea class="form-control" id="nota" name="nota" placeholder="Escribe tu nota aqui." rows="3" tabindex="15"></textarea>
                  <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
                </div>
              </div>

                    
                  </div>{{-- FIN COL  --}}
<!-- termina fila  -->

</div><!--termina row general  -->

<div class="row mx-5 mt-5" >
    <h4>Datos del vehiculo</h4>
    </div>

<div class="row border mx-5 py-4" style="background-color: white;" >
  

<br>
<div class="col-6">{{-- INICIO COL  --}}
                                  <label for="inputEmail3" class="col-sm-6 col-form-label">Tipo de Vehiculo</label>
                              {{-- Input de tipo de vehiculo  --}}
                              <div class="input-group">
                              
                                <select class="form-select form-control" id="tipo_vehiculo" name="tipo_vehiculo" tabindex="16" >
                                  <option value="" selected>Tipo de vehiculo</option>
                                  <option value="Motocicleta">Motocicleta</option>
                                  <option value="Vehiculo">Vehiculo</option>
                                  <option value="Camion">Camion</option>
                                </select>
                                <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
                              </div>
                
                                    
                                  </div>{{-- FIN COL  --}}
      
      
      
              <div class="col-6">{{-- INICIO COL  --}}
              <label for="inputEmail3" class="col-sm-6 col-form-label">Equipo es asignado</label>
                {{-- Input de numero de seguro  --}}
                <div class="input-group">
                
                  <select class="form-select form-control" id="asigno_unidad" name="asigno_unidad" tabindex="17">
                    <option value="" selected>Asigno unidad</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                    
                  </select>
                  <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
                </div>
                      
                      
                    </div>{{-- FIN COL  --}}
          
<!-- termina fila  -->


<br>
<div class="col-4">{{-- INICIO COL  --}}
          {{-- Input de numero de placa  --}}
          <div class="form-group">
          <label for="inputEmail3" class="col-sm-6 col-form-label">Numero de placa</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fa-solid fa-car-side"></i>
                </span>
              </div>
              <input type="text" class="form-control"  id="num_placa" name="num_placa" placeholder="Numero de Placa:" tabindex="18">
              <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
            </div>
          </div>
                                </div>{{-- FIN COL  --}}
                                
                                <div class="col-4">{{-- INICIO COL  --}}

         {{-- Input de numero de tarjeta  --}}
  
          
          <div class="form-group">
          <label for="inputEmail3" class="col-sm-6 col-form-label">Numero de tarjeta</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fa-solid fa-hashtag"></i>
                </span>
              </div>
              <input type="text" class="form-control " id="num_tarjeta" 
                     name="num_tarjeta" placeholder="Numero de tarjeta:" tabindex="19">
                     <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
                    </div>
          </div>

          </div>{{-- FIN COL  --}}

          <div class="col-4">{{-- INICIO COL  --}}   
          {{-- Input numero de licencia  --}}
          <div class="form-group">
          <label for="inputEmail3" class="col-sm-6 col-form-label">Numero de licencia</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fa-solid fa-id-card"></i>
                </span>
              </div>
              <input type="text" class="form-control " id="num_licencia" 
                     name="num_licencia" placeholder="Licencia de conducir:" tabindex="20" data-inputmask="'mask': '9999-999999-999-9'">
                     <div class="valid-feedback"><i class="fas fa-check-circle"></i>&nbsp;Correcto</div> 
                    </div>
          </div>                       
          </div>{{-- FIN COL  --}}
          
<!-- termina fila  -->


<br>
<div class="col-12">{{-- INICIO COL  --}}
      
      <div class="input-group mb-3">
      <label for="inputEmail3" class="col-sm-12 col-form-label">Fotografia del equipo</label>
        
      <input type="file" name="foto" class="form-control" tabindex="21">
      </div>

      
    </div>{{-- FIN COL  --}}
    <div class="modal-footer">
    <a href="/repartidores" class="btn btn-primary">Cancelar</a>
        &nbsp; &nbsp;
        <a href="/repartidores/create" class="btn btn-primary">Limpiar</a>
      &nbsp; &nbsp;
<button type="submit" class="btn btn-primary" tabindex="22">Guardar</button>

      </div>
<!-- termina fila  -->



</div><!--termina row general  -->

</form>












                                 
  
  
  



<br>
<br>
      
      
    

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://kit.fontawesome.com/b64093b700.js" crossorigin="anonymous"></script> 

   
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.3/jquery.inputmask.bundle.min.js"></script>


   
 
<script>
  $(document).ready(function(){
  
 /* $(":input").inputmask();*/
 Inputmask().mask(document.querySelectorAll("input"));
});
</script>
  




                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>    
@endsection

