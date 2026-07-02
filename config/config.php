<?php
$host = "localhost";
$port = "5432"; // Cambiado a número (5432 es el por defecto de PostgreSQL)
$usuario = "postgres";
$contrasena = "viernes83";
$base_de_datos = "INFORMESV1";

try {
    // La cadena de conexión ahora usará el puerto numérico correcto
    $conexion = new PDO("pgsql:host=$host;port=$port;dbname=$base_de_datos", $usuario, $contrasena);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Opcional: Solo para que sepas que funcionó al probarlo
    // echo "¡Conexión exitosa!"; 

} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
