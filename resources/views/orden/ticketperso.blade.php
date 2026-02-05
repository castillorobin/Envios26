<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        @page {
            
        }
        body {
            font-family: 'Helvetica', sans-serif;
            margin: 0;
            padding: 0;
           
        }
        /* Contenedor principal usando tabla para simular Flexbox */
        .tabla-principal {
            width: 100%;
            
            border-collapse: collapse;
           
        }

        /* Columna izquierda: PUNTO FIJO */
        .col-lateral {
            width: 14pt;
            text-align: center;
            vertical-align: middle;
            border-right: 1px solid #ccc;
        }

        .texto-rotado {
            /* Rotación compatible con DomPDF */
            transform: rotate(-90deg);
            white-space: nowrap;
            font-weight: bold;
            font-size: 12pt;
            letter-spacing: 1pt;
            display: block;
            width: 55pt; /* Altura total de la etiqueta */
            margin-left: -40pt; /* Ajuste manual de posición */
        }

        /* Columna derecha: Contenido */
        .col-contenido {
            text-align: center;
            vertical-align: middle;
            padding: 5pt;
        }

        .ruta {
            font-size: 12pt;
            margin-bottom: 2pt;
        }

        .ciudad {
            font-size: 16pt;
            font-weight: bold;
            margin: 2pt 0;
        }

        .fecha {
            font-size: 12pt;
        }

        hr {
            border: none;
            border-top: 1px solid #ccc;
            width: 80%;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <table class="tabla-principal">
        <tr>
            <td class="col-lateral">
                <span class="texto-rotado">PERSONALIZADO</span>
            </td>
            <td class="col-contenido">
                
                <div class="ciudad">{{ $orden->destino }}</div>
                <br>
                <hr>
                <div class="fecha">
                    {{ \Carbon\Carbon::parse($orden->fecha_entrega)->locale('es')->isoFormat('MMMM D, Y') }}
                </div>
            </td>
        </tr>
    </table>
</body>
</html>