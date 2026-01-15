<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "melo";
$password = "meloexpress";
$database = "pedidos";

// Nombre del archivo de respaldo
$backupFilename = 'respaldo.sql';

// Comando mysqldump
$command = "mysqldump --opt -h $servername -u $username -p$password $database > $backupFilename";

// Capturar el resultado del comando en una variable
ob_start();
passthru($command);
$backupContent = ob_get_clean();

// Configurar las cabeceras para la descarga
header('Content-Type: application/octet-stream');
header("Content-Disposition: attachment; filename=\"$backupFilename\"");

// Imprimir el contenido del respaldo
echo $backupContent;
?>
