
<!DOCTYPE html>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etiqueta</title>
    
    
    <style>
       @page {
		margin-left: 10px;
		margin-right: 10px;
        margin-bottom: 0.2cm;
        margin-top: 0.2cm;
	}
        .principal{
            
           width: 355px;
           font-size: 11px;
        }
        .logop{
            width: 190px;
            
        }

        .titulos{
            
            font-weight: bolder;
        }
body{
    
}
    </style>
<script type="text/javascript">
     function printHTML() { 
  if (window.print) { 
    window.print();
  }
}
document.addEventListener("DOMContentLoaded", function(event) {
  printHTML(); 
});
 </script>
 
</head>

<body onLoad="window.print()">


    <table style="width: 100%; border: 1px solid; height: 95%; ">
        <tr>
            <td >
            

            <img src="../public/img/logogris2.jpg" alt="" width="130px" style="margin-top:5px; margin-bottom:5px;"> 
        
        
            </td>
            <td style="text-align:right">
            <img src="../public/img/tele.jpg" alt="" width="12px" style="margin-top:5px; "> 2556-4494
            <br>
            <img src="../public/img/whats.jpg" alt="" width="12px" > 7457-6280
            </td>
        </tr>
        <tr >
            <td style="width: 60%; border-top: 1px solid; font-size:12px;">
            
            Comercio/tienda: 
        <br>
        <span class="titulos" style="font-size:12px; ">{{ $pedido->vendedor }}</span>
            </td>
            <td style=" border-top: 1px solid; text-align:center; font-size:12px;">
            
            Total a cobrar: <br><span class="titulos" style="font-size:12px;">${{ $pedido->total }}</span>
        
            </td>
        </tr>
        <tr style="font-size:10px; line-height : 15px;">
            <td style="border-top: 1px solid;">

            Id: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="titulos" >{{ $pedido->id }}</span>
        <br>
            Destinatario: <span class="titulos" >{{ $pedido->destinatario }}</span>
        <br>            
            Dirección:&nbsp; &nbsp; &nbsp;<span class="titulos" >{{ $pedido->direccion }}</span>
        
        <br>            
            Telefono:&nbsp; &nbsp; &nbsp; <span class="titulos" >{{ $pedido->telefono }}</span>
        <br>
               
            Whatsapp:&nbsp; &nbsp; <span class="titulos" >{{ $pedido->whatsapp }}</span>
        <br>
               
        Repartidor:&nbsp; &nbsp; <span class="titulos" >{{ $pedido->repartidor }}</span>
        <br>
               
        Nota:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span class="titulos" >{{ $pedido->nota }}</span>
        <br>


            </td>
            <td style="border-top: 1px solid; border-left: 1px solid; height: 60px !important; padding-left: 25px;"> <span> {!! DNS2D::getBarcodeHTML("http://54.237.159.219/pedido/verpedido/$pedido->id ", 'QRCODE' ,4,4) !!} </span></td>
        </tr>
        <tr>
            <td colspan="2" style="width: 60%; border-top: 1px solid;">
                Tipo de envio: 
                <br>
                <span class="titulos" style="font-size:18px; ">{{ $pedido->tipo }} </span>
                <br>
        </td>
        </tr>
        <tr>
            <td colspan="2" style="width: 60%; border-top: 1px solid; text-align:center;">
            Fecha de entrega:<span class="titulos" style="font-size:18px; "> {{  $fechal}} </span>
            
            
            <br>
       
            <div style="padding-left: 115px;"> {!! DNS1D::getBarcodeHTML($pedido->id , 'C39') !!} <span style="padding-right: 100px;"> {{ $pedido->id }} </span></div>
            </td>
        </tr>
    </table>

   
</body>


</html>