@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Melo Express</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card"> 
                        <div class="card-body">


                        <style>
   
.cambiar {
   
    float: left;
      
    }

.cambiar2 {
   
   float: right;
   margin-right: 20px;
}
.pagina1{
    margin-bottom: 30px;
    margin-top: -30px;
    
}
.pagina2{
    
    margin-bottom: -25px;
    padding-top: 10px;
    
}
.opciones li {
 display: block;
 transition-duration: 0.5s;
text-align: left;
 
}

.opciones li:hover {
  cursor: pointer;
  background:#b2b2b2;
}

.opciones ul li ul {
  visibility: hidden;
  opacity: 0;
  position: absolute;
  transition: all 0.5s ease;
  margin-top: 1rem;
  left: 0;
  display: none;
  
}

.opciones ul li:hover > ul,
ul li ul:hover {
  visibility: visible;
  opacity: 1;
  display: block;
  
}
.nocolor a:link, a:visited, a:active {
    text-decoration:none; 
    color:black;
            
        }

.dataTables_paginate a:hover {
    color: white !important;
    background:#0d6efd !important;
    
}


.dt-buttons button {
    background: #0275d8;
    color: white;
    border-radius: 5px;
    font-size: 16px;
    float: right;
}
.headt td {
  height: 15px !important;
  padding: 0px;
 font-size: 14px;
 background: #ffffff;
}

.modal-backdrop {
  z-index: -1;
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
    window.location = "https://appmeloexpress.com/comercio/filtrado/" + data.text; 
    //window.location = "http://127.0.0.1:8000/comercio/filtrado/" + data.text;
        });

    });
   
   
});



</script>


<div class="row" style="background-color: white;" >
<!--
<h8 style="font-size:14px" ><i class="fas fa-home"></i> Inicio / Almacen / Recolectas</h8>
-->
    <div class="  col-sm-12 py-3" >
        <h3 class="text-center">Listado de Comercios</h3>
    </div>



 
<div class="col-12">
<div class="row mt-1 mr-1">   
    <div class="input-group mb-3 col-6">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"> <i class="fas fa-search"></i> </span>
        </div>

        <select class="form-control mi-selector" name="comer" id="comer">
            <option value="">Buscar Comercio</option>
            @for($i=0;  $i< count($vendedores); $i++ )
            <option value="{{$vendedores[$i]->nombre}}">{{ $vendedores[$i]->nombre }} </option>
            @endfor
        </select>

    </div>
    
    <div class="d-flex justify-content-end col-6">
            @can('crear-comercios')
        <div >               
            <a href="/vendedores/create" class="btn btn-warning" style="color:white;"><i class="fas fa-database"></i> Agregar Comercio</a>
            <br>
        </div>
            @endcan
     </div>
     </div>






<div class="col-12 table-responsive" >
<br>
    <table id="tvendedores" class="table table-striped mt-2">
        <thead style="background-color:#6777ef;">
    <tr >
        
        <th style="color: #fff;">Comercio</th>
        <th style="color: #fff;">Direccion</th>
        <th style="color: #fff;">Teléfono</th>
        <th style="color: #fff;">Whatsapp</th>
        <th style="color: #fff;">Tipo de comercio</th>
        <th style="color: #fff;">Estado del comercio</th>
        <th style="color: #fff;">Fecha de alta</th>
        
        <th style="color: #fff;">Agencia</th>
        <th style="color: #fff;">Nota</th>
        <th style="color: #fff;">Opciones</th>
    </tr>
        </thead>
    <tbody>
   
    
    </tbody>
    </table>
    </div>
   

    </div>













<script src="https://code.jquery.com/jquery-3.5.1.js"></script>




	
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />



<script>
     



    </script>


                            
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>    
@endsection

