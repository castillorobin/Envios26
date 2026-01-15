<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    
</head>
<body>
<style>
        .fecha{
           
        }
        
.columna{
    width:350px;
}
.columna2{
    width:150px;
    text-align: center;
}
.centrar{
  
    text-align: center;
}
.melo{
    font-size: 26px;
    font-weight: bolder;
}
.compro{
    font-size: 10px;
    text-align: center;
}


    </style>

    <div style="width:100%; " class="text-center centrar">
    <img src="../public/img/logo.jpg" alt="" width="60%">
    <br>
            <span class="page__heading melo" >Melo Express</span>
           <!-- <img alt="image" src="/public/img/logo.png" > -->
           <br>
           <span>Servicios de Encomiendas</span>
           <br>
           <span>Centro Comercial Metrogaleria</span>
           local 3-9 San Salvador
        </div>
        

                        <div class="fecha centrar " style="font-weight: bolder;">
   Teléfono 7457-6280
   </div>
   <br>
   <div class="fecha centrar">
   Fecha: {{ now()->Format('d/m/Y')}} Hora: {{ now()->Format('H:i A')}}
   </div>
   <hr>
   <span>Id:</span>
   <br>
   <span>Cajero: {{\Illuminate\Support\Facades\Auth::user()->name}}</span>
   <br>
<span>Comercio: {{ $pedidos[0]->vendedor}}</span>
<br>
<span>Agencia: {{ $pedidos[0]->agencia}}</span>
<p></p>

<span style="font-weight: bolder;"> Paquetes cancelados</span>
<table style="width:100%; ">
<tbody>
@for($i=0;  $i< count($pedidos); $i++ )
<tr>
        <td>{{ $pedidos[$i]->destinatario}}</td>
        <td>$ {{ $pedidos[$i]->total}}</td>
    </tr>
       
                        @endfor
                                  

   </tbody>
</table>
<br>
<hr>
<table style="width:90%;  ">
<tbody>
    <tr>
        <td>Descuento:</td>
        <td>$ {{ $descue}} </td>
    </tr>
    <tr>
        <td>Total Pagado:</td>
        <td>$ {{ $total}} </td>
    </tr>
</tbody>
</table>

<p></p>
<p class="compro">
Para reclamos, por favor presentar este comprobante 

</p>
<p class="compro">Este documento no es un comprobante fiscal</p>

   


</body>
</html>
   