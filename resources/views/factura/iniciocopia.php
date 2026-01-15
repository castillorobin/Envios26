@extends('layouts.app')



@section('content')
<script>
        function doSearch()

{

    const tableReg = document.getElementById('datos');

    const searchText = document.getElementById('searchTerm').value.toLowerCase();

    let total = 0;



    // Recorremos todas las filas con contenido de la tabla

    for (let i = 1; i < tableReg.rows.length; i++) {

        // Si el td tiene la clase "noSearch" no se busca en su cntenido

        if (tableReg.rows[i].classList.contains("noSearch")) {

            continue;

        }



        let found = false;

        const cellsOfRow = tableReg.rows[i].getElementsByTagName('td');

        // Recorremos todas las celdas

        for (let j = 0; j < cellsOfRow.length && !found; j++) {

            const compareWith = cellsOfRow[j].innerHTML.toLowerCase();

            // Buscamos el texto en el contenido de la celda

            if (searchText.length == 0 || compareWith.indexOf(searchText) > -1) {

                found = true;

                total++;

            }

        }

        if (found) {

            tableReg.rows[i].style.display = '';

        } else {

            // si no ha encontrado ninguna coincidencia, esconde la

            // fila de la tabla

            tableReg.rows[i].style.display = 'none';

        }

    }



    // mostramos las coincidencias

    const lastTR=tableReg.rows[tableReg.rows.length-1];

    const td=lastTR.querySelector("td");

    lastTR.classList.remove("hide", "red");

    if (searchText == "") {

        lastTR.classList.add("hide");

    } else if (total) {

        td.innerHTML="Se ha encontrado "+total+" coincidencia"+((total>1)?"s":"");

    } else {

        lastTR.classList.add("red");

        td.innerHTML="No se han encontrado coincidencias";

    }

}
</script>

<style>
    .modal-backdrop {
  z-index: 0;
}

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
.pagina3{
   margin-bottom: 0px;
   margin-top: 0px;
   
}
.dataTables_paginate a:hover {
   color: white !important;
   background:#0d6efd !important;
   
}

.headt td {
  height: 15px !important;
  padding: 0px;
 font-size: 14px;
 background: #ffffff;
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
            var total = document.getElementById('preci2').textContent;
            var desc = document.getElementById('descu').value;
            document.getElementById('preci2').innerHTML = parseFloat(total) + parseFloat(desc) ; 
            document.getElementById('toti').value = parseFloat(total) + parseFloat(desc) ; 
            document.getElementById('descu').value = 0;

  }else{
    div = document.getElementById('flotante');
            div.style.display = '';
            div2 = document.getElementById('flotante2');
            div2.style.display = '';
  }
}




function ivan()
{
    var total = document.getElementById('preci2').textContent;
		//var ivavalor = 1.0;
        //var iva = parseFloat(total, 10) + parseFloat(ivavalor, 10);
        //alert("le diste click" + prec);
        var tiva = document.getElementById('atotal').textContent;
       
         

        if (document.getElementById("checkiva").checked) {
            
            //var to3 = parseFloat(total, 10) + parseFloat(ivavalor, 10);
            document.getElementById('preci2').innerHTML = parseFloat(total) - parseFloat(tiva) ; 
            document.getElementById('toti').value = parseFloat(total) - parseFloat(tiva) ; 
           
            //document.getElementById(preci2) = to4;  
        } else {
            document.getElementById('preci2').innerHTML = document.getElementById('preci').textContent ; 
            document.getElementById('toti').value = document.getElementById('preci').textContent ; 
        
        
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
    console.log(data.text);
   //document.getElementById('mostrar').value = data.text;
   //window.location = "https://appmeloexpress.com/facturasfiltro/" + data.text; 
   window.location = "http://127.0.0.1:8000/facturasfiltro/" + data.text;

        });



        
   
    });

 
    
});



</script>

<script>
    function redireccionarPagina(){
    window.setTimeout( abrirURL, 2000 ); // 3 segundos
};
    
function abrirURL(){
    //Abrir URL que necesites
    window.location = "http://127.0.0.1:8000/facturas/";
    //window.location = "https://appmeloexpress.com/facturas/";
};
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
                            <form action="/factura/facturapdf/{{$vende[0]->nombre }}" method="get">
            <div class="row  py-2" style="background-color: white;" >   <!-- Inicia fila General -->
            <div class="col-12 text-center pt-3 mb-3" style="background-color:#e85f24; color:white; height:75px;">  <!-- Inicia columna total  -->
<H1>Total $ <label for="" id="preci">0</label></H1>

</div> <!-- Termina columna total  -->

                <div class="col-12">   <!-- Inicia columna 8  -->
                
                <div class="row mt-1 border mr-1">   
                
                <div class="col-sm-6 mt-4"> <!-- div buscar -->

<div class="input-group mb-3 ">

<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1"> <i class="fas fa-search"></i> </span>
</div>
<select class="form-control mi-selector" name="comer" id="comer">
    
    <option value="{{$vende[0]->nombre }}" selected >{{$vende[0]->nombre }}</option>
    @for($i=0;  $i< count($vendedores); $i++ )
                    <option value="{{$vendedores[$i]->nombre}}">{{ $vendedores[$i]->nombre }} </option>
       
                        @endfor
</select>

</div>
</div> <!-- Termina div buscar  -->


<div class="col-6 mt-4">  <!-- div filtrros  -->

<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal3" >Ver</button>
@can('editar-rol')
<a href="/vendedores/{{ $vende[0]->id }}/edit" class="btn btn-success" >Editar</a>
@endcan
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
 Pagar
</button>

<a href="/factura/listado" >
<button type="button" class="btn btn-warning"  >
 Detalles de Pago
</button></a>

<div style="float:right;">

<input id="searchTerm" class="form-control" placeholder="Buscar" type="text" onkeyup="doSearch()" />
</div>
                </div> <!-- Termina div filtros  -->

<div class="col-12 table-responsive " style="height:400px; " ><!-- div tabla  -->



<table id="datos" class="table table-striped mt-2">
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
        <th style="color: #fff;">Nota</th>
        <th style="color: #fff;">Opciones</th>
    </tr>
</thead>
<tbody> 
</tbody> 
@for($i=0;  $i< count($pedidos); $i++ )
<tr>
                    <td >
                    <div class="form-group form-check" style="width: 5px;">
                     <input type="checkbox" value="{{ $pedidos[$i]->id }}" class="form-check-input" id="check3" name="checked[]" >
                     
                    </div>
                    </td>
                    <td>{{ $pedidos[$i]->vendedor }} </td>
                    <td>{{ $pedidos[$i]->destinatario }} </td>
                    <td>{{ $pedidos[$i]->direccion }} </td>
                    <td>{{ $pedidos[$i]->tipo }}</td>  
                    <td style="background: #e3e8e7; text-align:center; font-size: 15px;"><span class="badge badge-dark">{{ $pedidos[$i]->estado }} </span></td>
                    <td>{{  date('d/m/Y', strtotime($pedidos[$i]->fecha_entrega))}} </td>

                    @if($pedidos[$i]->pagado=='Pagado')
                    <td class="text-center"><h5><span class="badge badge-success ">{{ $pedidos[$i]->pagado }} </span></h5></td>
                    @else
                    <td class="text-center"><h5><span class="badge badge-danger ">{{ $pedidos[$i]->pagado }} </span></h5></td>
                    @endif

                   
                    <td>{{ $pedidos[$i]->precio }}  </td>
                    <span hidden id="pre{{ $pedidos[$i]->id }}"> {{ $pedidos[$i]->precio}}</span>
                    <td>{{ $pedidos[$i]->envio }} </td>
                    <span hidden id="env{{ $pedidos[$i]->id }}"> {{ $pedidos[$i]->envio}}</span>
                    <td>{{ $pedidos[$i]->total }} </td>
                    <td>{{ $pedidos[$i]->agencia }} </td>
                    <td>{{ $pedidos[$i]->nota }} </td>
    <span hidden id="nom{{ $pedidos[$i]->id }}"> {{ $pedidos[$i]->vendedor }}</span>
    <span hidden id="des{{ $pedidos[$i]->id }}"> {{ $pedidos[$i]->destinatario }}</span>
    <span hidden id="tel{{ $pedidos[$i]->id }}"> {{ $pedidos[$i]->telefono }}</span>
    <span hidden id="dir{{ $pedidos[$i]->id }}"> {{ $pedidos[$i]->direccion}}</span>
    <span hidden id="fec{{ $pedidos[$i]->id }}"> {{  date('d/m/Y', strtotime($pedidos[$i]->created_at))  }}</span>
    <span hidden id="fece{{ $pedidos[$i]->id }}"> {{  date('d/m/Y', strtotime($pedidos[$i]->fecha_entrega))}}</span>
    <span hidden id="tip{{ $pedidos[$i]->id }}"> {{ $pedidos[$i]->tipo}}</span>
    <span hidden id="este{{ $pedidos[$i]->id }}"> {{ $pedidos[$i]->estado}}</span>
    <span hidden id="estp{{ $pedidos[$i]->id }}"> {{ $pedidos[$i]->pagado}}</span>
    <span hidden id="pre{{ $pedidos[$i]->id }}"> {{ $pedidos[$i]->precio}}</span>
    <span hidden id="env{{ $pedidos[$i]->id }}"> {{ $pedidos[$i]->envio}}</span>
    <span hidden id="tot{{ $pedidos[$i]->id }}"> {{ $pedidos[$i]->total}}</span>
    <span hidden id="ing{{ $pedidos[$i]->id }}"> {{ $pedidos[$i]->ingresado}}</span>
    <span hidden id="ang{{ $pedidos[$i]->id }}"> {{ $pedidos[$i]->agencia}}</span>
    <span hidden id="rep{{ $pedidos[$i]->id }}"> {{ $pedidos[$i]->repartidor}}</span>
    <span hidden id="rut{{ $pedidos[$i]->id }}"> {{ $pedidos[$i]->ruta}}</span>
    <span hidden id="cob{{ $pedidos[$i]->id }}"> {{ $pedidos[$i]->cobroenvio}} </span>
    <span hidden id="not{{ $pedidos[$i]->id }}"> {{ $pedidos[$i]->nota}}</span>
    <span hidden id="med{{ $pedidos[$i]->id }}"> {{ $pedidos[$i]->medio}}</span>
    <span hidden id="fot{{ $pedidos[$i]->id }}"> /imgs/fotos/{{ $pedidos[$i]->foto}}</span>
    <span hidden id="fot2{{ $pedidos[$i]->id }}"> /imgs/fotos/{{ $pedidos[$i]->foto2}}</span>
    <span hidden id="fot3{{ $pedidos[$i]->id }}"> /imgs/fotos/{{ $pedidos[$i]->foto3}}</span>
    


                    <td class="opciones text-center" style="">
    
  
  
 
    <a href="" class="dropdown-toggle" data-toggle="dropdown">

    <i class="fas fa-list"></i></a>
    <ul class="dropdown-menu" style="background-color: #ffffff;"> 
    @can('editar-rol')
     <div class="botones"> 

    <li class="botones">
    &nbsp;
    <i class="fas fa-edit"></i>
    &nbsp;&nbsp;
    <a href="/pedido/editando/{{ $pedidos[$i]->id }}" >Editar</a></li> 
    </div>  
    @endcan
	<li class="botones">
   
    &nbsp;
    <i class="fas fa-eye"></i>
    &nbsp;&nbsp;
    <button type="button" class="edit" data-toggle="modal" value="{{ $pedidos[$i]->id }}" data-target="#exampleModal2" style="background: none; border: 0;">Ver</button>

</li>
@can('crear-rol')
<li class="botones">
    <form action="{{ route ('pedidos.destroy', $pedidos[$i]->id)}}" method="POST">
        @csrf
        @method('DELETE')
        &nbsp;
        <i class="fas fa-trash-alt"></i> 
        &nbsp;&nbsp;
        <button style="background: none; border: 0;">Eliminar</button>
        </form>
        </li>
        @endcan
    </ul>
 
  <!--
 <a class="btn btn-info" href="{{ route('pedidos.edit', $pedidos[$i]->id) }}">Editar</a>


 <form action="{{ route ('pedidos.destroy', $pedidos[$i]->id)}}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">Eliminar</button>
        </form>

-->

    </td>




                    </tr>
                        @endfor
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
<tr class='noSearch hide'>

                <td colspan="13"></td>

            </tr>




</table>

<table class="table table-striped mt-2">
    
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
<td colspan="2">$<label for="" id="sumas">0</label></td>
    <td>$<label for="" id="ivat">0</label></td>
    <td > $<label for="" id="stotal">0</label></td>
    <td  colspan="2">$ 000.00</td>
    <td  colspan="2">$000.00</td>
    <td  colspan="2">$<label for="" id="atotal">0</label></td>
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
        <button type="button" class="close btn-lg" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      
      <div class="col-12 border px-0 mt-1">  <!-- Inicia columna 4  -->
      <div class="col-12 text-center pt-2 mb-3" style="background-color:#e85f24; color:white; height:75px;">  <!-- Inicia columna total  -->
<H1>Total $ <label for="" id="preci2">0</label></H1>
<br>

<input hidden type="text" id="toti" name="toti" >

</div> <!-- Termina columna total  -->
<div class="col-12">  <!-- Inicia cajero, pagos etc. -->

Cajero
<input type="text" class="form-control" name="cajero" id="cajero" value="{{\Illuminate\Support\Facades\Auth::user()->name}}" readonly>
<br>
<div class="row pt-2">
    
<div class="col-6">Medio de pago
    <select name="medios" id="medios" class="form-control">
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

<input type="text" class="form-control" name="fpago" id="fpago" value="{{ date('Y/m/d') }}" aria-label="Username" aria-describedby="basic-addon1" readonly>

</div>





</div>
</div>



<br>

<div class="row pt-2">
    
<div class="col-6">Tipo de comprobante
    <select name="comp" id="comp" class="form-control">
    <option value="Sin comprobante" selected>Sin comprobante</option>
        <option value="Ticket">Ticket</option>
        <option value="Factura">Factura</option>
        <option value="Credito Fiscal">Crédito Fiscal</option>
        <option value="PDF">PDF</option>
        
        
    </select>

</div>
<div class="col-6">
    

No. de comprobante

<div class="input-group ">
<div class="input-group-prepend">

</div>

<input type="text" class="form-control" name="ncompro" id="ncompro" aria-label="Username" aria-describedby="basic-addon1" >

</div>





</div>
</div>
<br>

<div class="col-12">
<div class="form-group form-check">
<input type="checkbox" class="form-check-input" id="checkiva" Onclick="javascript:ivan();">
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

<input type="text" class="form-control" name="descu" id="descu"  aria-label="Username" aria-describedby="basic-addon1">

</div>






</div>
</div>

<br>
<div class="col-12" id="flotante2" style="display:none;">
Nota de descuento
<input type="text" class="form-control" name="ndescu" id="ndescu"  aria-label="Username" aria-describedby="basic-addon1">
</div>









<br>
<div class="col-12 mb-3">

<button type="submit" class="btn btn-lg btn-warning btn-block" formtarget="_blank" onclick="redireccionarPagina()">PAGAR</button> 
</div>

</div> <!-- Termina cajero, pagos etc.  -->
</div> <!-- Termina columna 4  -->



      </div>
      <div class="modal-footer " style="background-color:white;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>


            <!-- Termina Modal -->











<!-- Inicio Modal Ver-->

<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel" style="float: left;"></h1> &nbsp; &nbsp; &nbsp;
        <span style="float: right; text-align: right;"><button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button></span>
      </div>
      <div class="modal-body">
        <div class="row p-3 m-3" style="border: solid 1px;">
           
            <table class="table table-borderless" >
                <tr>
                    <td  colspan="3"><h4>Datos del Comercio</h4>
                        <hr>
                    </td>
                    
                </tr>

                <tr class="headt">
                    <td width="230px">Nombre de comercio / Tienda </td>
                    <td> <span ></span> <label for="" id="nombre"></label> </td>
                    <td rowspan="15"><span ></span> <label for="" > </label> <img alt="" class=" img-thumbnail" id="fotos" width="250"> 
                    <br> <img alt="" id="fotos2" width="250">
                    <br> <img alt="" id="fotos3" width="250"></td>
                </tr>

                <tr class="headt">
                    <td width="230px">Dirección </td>
                    <td> <span ></span> <label for="" id="dire"></label> </td>
                    
                </tr>
                
               
                <tr class="headt">
                    <br>
                    <td  colspan="3" class="pt-2"> <h4> Datos del destinatario</h4>
                        <hr>
                    </td>
                      
                </tr>

                <tr class="headt">
                    <td width="230px">Destinatario </td>
                    <td> <span ></span> <label for="" id="desti"></label> </td>
                    
                </tr>         

                <tr class="headt">
                    <td width="230px">Telefono </td>
                    <td> <span ></span> <label for="" id="telef"></label> </td>
                    
                </tr>
                <tr class="headt">
                    <td width="230px">Direccion de entrega </td>
                    <td> <span ></span> <label for="" id="direc"></label> </td>
                    
                </tr>
                

                <tr class="headt">
                    <br>
                    <td  colspan="3" class="pt-2"> <h4> Datos del paquete</h4>
                        <hr>
                    </td>
                      
                </tr>

                <tr class="headt">
                    <td width="230px">Fecha de creacion </td>
                    <td> <span ></span> <label for="" id="fecha"></label> </td>  
                </tr>
                <tr class="headt">
                    <td width="230px">Fecha de entrega </td>
                    <td> <span ></span> <label for="" id="fechen"></label> </td>  
                </tr>
                <tr class="headt">
                    <td width="230px">Tipo de envio </td>
                    <td> <span ></span> <label for="" id="tipoe"></label> </td>  
                </tr>
                </tr>
                <tr class="headt">
                    <td width="230px">Estado del envio </td>
                    <td> <span ></span> <label for="" id="este"></label> </td>  
                </tr>
                <tr class="headt">
                    <td width="230px">Estado del pago </td>
                    <td> <span ></span> <label for="" id="estp"></label> </td>  
                </tr>
                <tr class="headt">
                    <td width="230px">Precio del paquete </td>
                    <td> <span ></span> <label for="" id="preci"></label> </td>  
                </tr>
                <tr class="headt">
                    <td width="230px">Costo del envio </td>
                    <td> <span ></span> <label for="" id="envio"></label> </td>  
                </tr>
                <tr class="headt">
                    <td width="230px">Total a cobrar </td>
                    <td> <span ></span> <label for="" id="total"></label> </td>  
                </tr>

                <tr class="headt">
                    <td width="230px">Cobro del envio </td>
                    <td> <span ></span> <label for="" id="cobro"></label> </td>  
                </tr>
                <tr class="headt">
                    <td width="230px">Medio de pago</td>
                    <td> <span ></span> <label for="" id="medio"></label> </td>  
                </tr>
               
             
                <tr class="headt">
                    <br>
                    <td  colspan="3" class="pt-2"> <h4> Datos internos</h4>
                        <hr>
                    </td>
                      
                </tr>

                <tr class="headt">
                    <td width="230px">Usuario que registró </td>
                    <td> <span ></span> <label for="" id="ingre"></label> </td>  
                </tr>
                <tr class="headt">
                    <td width="230px">Recepción agencia </td>
                    <td> <span ></span> <label for="" id="agen"></label> </td>  
                </tr>
                <tr class="headt">
                    <td width="230px">Repartidor </td>
                    <td> <span ></span> <label for="" id="repar"></label> </td>  
                </tr>
                <tr class="headt">
                    <td width="230px">Ruta </td>
                    <td> <span ></span> <label for="" id="ruta1"></label> </td>  
                </tr>
                <tr class="headt">
                    <td width="230px">Nota </td>
                    <td> <span ></span> <label for="" id="nota1"></label> </td>  
                </tr>


            </table>


        </div>



       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times" style="color: #ffffff;"></i> &nbsp; Cerrar</button>
        <a id="impri" class="btn btn-primary" style="color: #ffffff;">Imprimir</a>
      </div>
    </div>
  </div>
</div>


<!-- Termina Modal ver-->








<!-- Inicio Modal ver vendedor-->

<div class="modal fade" id="exampleModal3"  aria-labelledby="exampleModalLabel3" aria-hidden="true" style="z-index: 999999999;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel3" style="float: left;"></h1> &nbsp; &nbsp; &nbsp;
        <span style="float: right; text-align: right;"><button type="button" class="btn-close btn-lg" data-dismiss="modal" aria-label="Close">X</button></span>
      </div>
      <div class="modal-body">
        <div class="row p-3 m-3" style="border: solid 1px;">
           
            <table class="table table-borderless" >
                <tr>
                    <td  colspan="2"><h4>Informacion del Comercio </h4>
                        <hr>
                    </td>
                    
                </tr>
                <tr class="headt">
                    <td width="230px">Comercio / tienda </td>
                    <td> <span ></span> <label for="" > {{ $vende[0]->nombre}}</label> </td>
                    
                </tr>
                <tr class="headt">
                    <td width="230px">Dirección </td>
                    <td> <span ></span> <label for=""> {{ $vende[0]->direccion}}</label> </td>
                    
                </tr>
                <tr class="headt">
                    <td width="200px">Teléfono </td>
                    <td> <span ></span> <label for="" > {{ $vende[0]->telefono}}</label> </td>
                    
                </tr>
                <tr class="headt">
                    <td width="200px">Whatsapp</td>
                    <td> <span ></span> <label for="" > {{ $vende[0]->whatsapp}}</label> </td>
                    
                </tr>
                <tr class="headt">
                    <td width="200px">Fecha de Alta</td>
                    <td> <span ></span> <label for="" > {{  date("d/m/Y", strtotime($vende[0]->falta))  }}</label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Fecha de Baja</td>
                    <td> <span ></span> <label for="" >{{  date("d/m/Y", strtotime($vende[0]->fbaja))  }}</label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Tipo de Comercio</td>
                    <td> <span ></span> <label for="" ></label> {{ $vende[0]->tipovende}}</td>
                </tr>
                <tr class="headt">
                    <td width="200px">Correo</td>
                    <td> <label for="" >{{ $vende[0]->correo}}</label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Estado del comercio </td>
                    <td> <label for="" >{{ $vende[0]->estado}}</label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Agencia </td>
                    <td> <label for="" >{{ $vende[0]->agencia}}</label> </td>
                </tr>

                <tr class="headt">
                    <br>
                    <td  colspan="2" class="pt-2"> <h4> Datos Bancarios</h4>
                        <hr>
                    </td>
                     
                </tr>
                <tr class="headt">
                    <td width="230px">Nombre del titular de la cuenta </td>
                    <td> <label for="" >{{ $vende[0]->titular}}</label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Nombre del Banco </td>
                    <td> <label for="" >{{ $vende[0]->banco}}</label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Número de cuenta </td>
                    <td> <label for="" >{{ $vende[0]->cuenta}}</label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Tipo de cuenta </td>
                    <td> <label for="" >{{ $vende[0]->tcuenta}}</label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Numero de Chivo Wallet </td>
                    <td> <label for="" >{{ $vende[0]->chivo}}</label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Numero de Tigo Money </td>
                    <td> <label for="" >{{ $vende[0]->tmoney}}</label> </td>
                </tr>
                <tr class="headt">
                    <td  colspan="2" class="pt-2"> <h4>Información Fiscal</h4>
                        <hr>
                    </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Nombre de la empresa</td>
                    <td> <label for="" >{{ $vende[0]->empresa}}</label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Giro</td>
                    <td> <label for="" >{{ $vende[0]->giro}}</label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Numero de DUI </td>
                    <td> <label for="" >{{ $vende[0]->dui}}</label> </td>
                </tr>
                <tr tr class="headt">
                    <td width="200px">Numero de IVA </td>
                    <td><label for="" >{{ $vende[0]->niva}}</label> </td>
                </tr>
                <tr class="headt">
                    <td width="200px">Numero de NRC </td>
                    <td> <label for="" >{{ $vende[0]->nrc}}</label> </td>
                </tr>


            </table>


        </div>



       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times" style="color: #ffffff;"></i> &nbsp; Cerrar</button>
        
      </div>
    </div>
  </div>
</div>


<!-- Termina Modal ver vendedor-->









                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>    
    
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    

               





    
         <script>
        
$(document).ready(function(){

    $("#descu").change(function() {

//alert('hola mundo');

var total = document.getElementById('preci2').textContent;

//const preci = parseFloat(document.getElementById("precio").value);						                                                    
const desc =parseFloat($(this).val()); 
var final = total - desc ;

document.getElementById("preci2").textContent = final;
document.getElementById("toti").value = final;

 



 });



	$(document).on('click', '#check3', function(){
		var id=$(this).val();
		var prec=parseFloat($('#tot'+id).text());
        var envi=$('#env'+id).text();
        
        //alert("le diste click" + prec);
        var tota = $('#preci').text();
        var senvi = $('#sumas').text();
        //var tota = parseFloat(tota, 10);

        if ($(this).prop('checked')) {

            var to3 = parseFloat(tota, 10) + parseFloat(prec, 10);
            var tenv = parseFloat(senvi, 10) + parseFloat(envi, 10);
        $('#preci').text(parseFloat(to3, 10)); 
        $('#preci2').text(to3); 
        $('#toti').val(to3); 
        $('#sumas').text(tenv);  

        } else {
            var to3 = parseFloat(tota, 10) - parseFloat(prec, 10);
            var tenv = parseFloat(senvi, 10) - parseFloat(envi, 10);
        $('#preci').text(to3); 
        $('#preci2').text(to3);
        $('#toti').val(to3);
        $('#sumas').text(tenv);  
        }

    

       
       $('#ivat').text((parseFloat(tenv, 10) * 0.13).toFixed(2) ); 
        $('#stotal').text(parseFloat(tenv, 10) + (parseFloat(tenv, 10) * 0.13) ); 
        $('#atotal').text(parseFloat(tenv, 10) + (parseFloat(tenv, 10) * 0.13) ); 
  
     

    });
   
    
    


   // $(document).on('change', '.selection', function(){   
//console.log('Hola');
 //   });
    
});
 



        </script> 
        
<script>
       
        
       $(document).ready(function(){
           $(document).on('click', '.edit', function(){
               var id=$(this).val();
               var nomb=$('#nom'+id).text();
               var dest=$('#des'+id).text();
               var tele=$('#tel'+id).text();
               var dire=$('#dir'+id).text();
               var fech=$('#fec'+id).text();
               var feche=$('#fece'+id).text();
               var tipo=$('#tip'+id).text();
               var est=$('#este'+id).text();
               var esp=$('#estp'+id).text();
               var prec=$('#pre'+id).text();
               var envi=$('#env'+id).text();
               var tota=$('#tot'+id).text();
               var ingr=$('#ing'+id).text();
               var ange=$('#ang'+id).text();
               var repa=$('#rep'+id).text();
               var cobr=$('#cob'+id).text();
               var ruta=$('#rut'+id).text();
               var nota=$('#not'+id).text();
               var medi=$('#med'+id).text();
               var foto=$('#fot'+id).text();
               var foto2=$('#fot2'+id).text();
               var foto3=$('#fot3'+id).text();
               
               //foti= '/imgs/fotos/';
       
               
           
               $('#edit').modal('show');
               $('#nombre').text(nomb);
               $('#desti').text(dest);
               $('#telef').text(tele);
               $('#direc').text(dire);
               $('#fecha').text(fech);
               $('#fechen').text(feche);
               $('#tipoe').text(tipo);
               $('#este').text(est);
               $('#estp').text(esp);
               $('#preci').text(prec);  
               $('#envio').text(envi);
               $('#total').text(tota);
               $('#ingre').text(ingr);
               $('#agen').text(ange);
               $('#repar').text(repa);
               $('#ruta1').text(ruta);
               $('#nota1').text(nota);
               $('#medio').text(medi);
               $('#empresa').text(empre);
               $('#giro').text(gir); 
               $('#cobro').text(cobr);    
               $('#nrc').text(nr);
               var ide = '/repartidor/imprimir/'+id ;
               $('#fotos').attr("src", foto);
               $('#fotos2').attr("src", foto2);
               $('#fotos3').attr("src", foto3);
              
               //$('#impri a').prop("href", ide);
               //$('.paginacion a').prop('href','http://nuevaUrl.com');
       
               document.getElementById("impri").href = ide;
           });
       });
        
      </script>



           
@endsection
