<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Guía</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
    @page {
        margin: 5px; /* Margen mínimo para que la impresora no corte el texto */
    }
    body {
        
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        text-align: center;
    }
    .guia-header {
        text-align: center;
        font-weight: bold;
        font-size: 14px;
        margin-bottom: 5px;
    }
    .barcode-container {
        text-align: center;
        margin-top: 5px;
    }
    .text-vertical {
  transform: rotate(270deg);
  white-space: nowrap; /* Evita que el texto se rompa en líneas */
}
</style>
</head>
<body>
    <p></p>
    <table class="text-center" style="width:100%;  ">
        <tr class="text-center">
            <td rowspan="3" class="text-vertical" style="width: 10px;"><h1>Punto Fijo</h1></td>
            <td class="text-center"><h1>Ruta {{ $punto->ruta }}</h1>
        <hr>
    </td>
            
        </tr>
        <tr>
            <td><h1>{{ $punto->nombre }}</h1>
        <hr>
    </td>
            
        </tr>
        <tr>
            <td><h1>{{ $orden->fecha_entrega }}</h1></td>
        </tr>
    </table>
    
</body>
</html>