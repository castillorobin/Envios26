<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Envios</title>
</head>
<body>
<style>
        .fecha{
            float: right;
        }
        
.columna{
    width:350px;
}
.columna2{
    width:150px;
    text-align: center;
}




    </style>
    {{date_default_timezone_set('America/El_Salvador') }}
    <div>
 <img src="../public/img/logo.jpg" alt="" width="10%">
            <h3 class="page__heading">Melo Express</h3>
            <div style="width:100%; text-align: right; " >
   Fechaaaa: {{ now()->Format('d/m/Y')}} Hora: {{ date("H:i:s")}}
  
   </div>
        </div>
       
 
   
   <hr>
      <span>Operario: {{\Illuminate\Support\Facades\Auth::user()->name}}</span>
   <br>
<span>Repartidor: {{ $pedidos[0]->repartidor}}</span>
<br>
<span>Ruta: {{ $pedidos[0]->ruta}}</span>
<br>
<span>Cantidad: {{ $cant}}</span>
<p></p>
<p></p>



<table class="table table-bordered shadow-lg mt-4" style="width:100%">
<thead >
    <tr style='background: #223161; color:white; font-size:13px; text-align: center;'>
        
    <th scope="col">ID</th>
    <th scope="col">Comercio</th>
        <th scope="col">Destinatario</th>
        <th scope="col">Direccion</th>
        
        <th scope="col">Tipo</th>
        <th scope="col">Estado del envio</th>
        <th scope="col">Fecha de entrega</th>
        <th scope="col">Precio</th>
        <th scope="col">Envio</th>
        <th scope="col">Total</th>
        
        
    </tr>
</thead>
<tbody>
    @foreach($pedidos as $pedido)
    <tr style='border-bottom: 1px solid; font-size: 12px'>
    
    <td >{{ $pedido->id }}</td>
    <td >{{ $pedido->vendedor }}</td>
    <td >{{ $pedido->destinatario }}</td>
    <td>{{ $pedido->direccion }}</td>

    <td>{{ $pedido->tipo }}</td>
    <td> {{ $pedido->estado }}</td>
    <td> {{  date('d/m/Y', strtotime($pedido->fecha_entrega))}}</td>
    <td >${{ $pedido->precio }}</td>
    <td >${{ $pedido->envio }}</td>
    <td> ${{ $pedido->total }}</td>
    
    
</tr>

    @endforeach
</tbody>
</table>
<br>
<p></p>
<hr>

<table style="width:100%;  ">
   
<tr >
       <td style="width:80%; ">&nbsp;</td>
       
       <td >  </td>
       
   </tr>

   <tr  >
   <td>&nbsp;</td>
   
       <td >  
       Total Cobrado:  ${{ $cobrado }} 
       <br>
       Total sin envio:  ${{ $total }} 
        <br>
        Total de Envio: ${{ $tenvi }} 
       </td>
       
   </tr>
  </table>   
  <span style="font-weight: bolder;"> Centro Comercial Metrogaleria</span>
           local 3-9 San Salvador
        </div>
        

                        <div style="font-weight: bolder;">
   Teléfono 7457-6280
   </div>

  <p></p>

   


</body>
</html>
   