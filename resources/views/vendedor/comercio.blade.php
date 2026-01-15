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

  


<div class="row" style="background-color: white;" >
<!--
<h8 style="font-size:14px" ><i class="fas fa-home"></i> Inicio / Almacen / Recolectas</h8>
-->
    <div class="  col-sm-12 py-3" >
        <h3 class="text-center">Listado de Mis Envios</h3>
    </div>

 
 





<div class="col-12 table-responsive" >
<br>
    <table id="tvendedores" class="table table-striped mt-2">
        <thead style="background-color:#6777ef;">
    <tr >
        
        <th style="color: #fff;">ID</th>
        <th style="color: #fff;">Fecha de entrega</th>
        <th style="color: #fff;">Estado de entrega</th>
        <th style="color: #fff;">Nota</th>
 
    </tr>
        </thead>
    <tbody>
   



  

    
    </tbody>
    </table>
    </div>
   

    </div>








<script src="https://code.jquery.com/jquery-3.5.1.js"></script>




	
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />


    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" defer></script>

    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js" defer></script>

<script>
 

       $(document).ready(function () {
    $('#tvendedores').DataTable(
        {
            language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    },
        
        dom: 'tri',
       

        } /*hasata aqui*/
    );
});





    </script>


                            
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>    
@endsection

