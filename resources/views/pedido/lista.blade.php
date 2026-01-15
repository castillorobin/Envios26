<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte del dia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css">
    

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
</head>

<body>

    
   Reporte del día
   <div class="fecha">
   Fecha: {{ now()->Format('d/m/Y')}} Hora: {{ now()->Format('H:i A')}}
   </div>
   <hr>
<p></p>
   <table >
    <tr>
        <td class="columna" ><b> Caja: </b> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 1  </td>
   
        <td class="columna">  <b> Entregados: </b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{ $numentre }}   </td>
        <td class="columna2"> $ {{ $totalentre }}</td>
    </tr>
    <tr>
        <td class="columna"><b> Usuario: </b> &nbsp;&nbsp; &nbsp; &nbsp; 1 </td>
        <td class="columna">  <b> Reprogramados: </b>  {{ $numrepro }} </td>
        <td class="columna2"> $ {{ $totalrepro }}</td>
    </tr>
    <tr>
        <td class="columna"><b> Repartidor: </b>{{ $repar }} </td>
        <td class="columna">  <b> No entregados: </b> &nbsp; &nbsp;0 </td>
        <td class="columna2">$ 0 
            
        </td>
    </tr>
    <tr>
        <td class="columna"><b> Ruta: </b>  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{ $rutat }} </td>
        <td class="columna">     </td>
        <td style="border-top: 1px solid;"> </td>
    </tr>
    <tr>
        <td class="columna"><b> Envios: </b> &nbsp; &nbsp; &nbsp; &nbsp; {{ $cuantos }}   </td>
        <td class="columna">  Total   </td>
        <td class="columna2"> $ {{ $totalentre - $totalrepro}}</td>
    </tr>
   </table>

   <br>
<table class="table table-bordered shadow-lg mt-4" style='id;'>
<thead >
    <tr style='background: #223161; color:white; font-size:13px; text-align: center;'>
        
        <th scope="col">Comercio</th>
        <th scope="col">Destinatario</th>
        <th scope="col">Direccion</th>
        
        <th scope="col">Tipo</th>
        <th scope="col">Estado del envio</th>
        <th scope="col">Fecha de entrega</th>
        <th scope="col">Agencia</th>
        <th scope="col">Repartidor</th>
        <th scope="col">Ruta</th>
        <th scope="col">Nota</th>
        
    </tr>
</thead>
<tbody>
    @foreach($pedidos as $pedido)
    <tr style='border-bottom: 1px solid;'>
    
    <td >{{ $pedido->vendedor }}</td>
    <td >{{ $pedido->destinatario }}</td>
    <td>{{ $pedido->direccion }}</td>
    <td>{{ $pedido->tipo }}</td>
    <td> {{ $pedido->estado }}</td>
    <td> {{ $pedido->fecha_entrega }}</td>
    <td> {{ $pedido->agencia }}</td>
    <td> {{ $pedido->repartidor }}</td>
    <td> {{ $pedido->ruta }}</td>
    <td> {{ $pedido->nota }}</td>
    
</tr>

    @endforeach
</tbody>
</table>



   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>

