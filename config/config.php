<?php
// Configuración de conexión a PostgreSQL usando variables de entorno para seguridad
$host = getenv('DB_HOST') ?: "localhost";
$port = getenv('DB_PORT') ?: "5432";
$usuario = getenv('DB_USER') ?: "postgres";
$contrasena = getenv('DB_PASSWORD') ?: "";
$base_de_datos = getenv('DB_NAME') ?: "INFORMESV1";

try {
    // La cadena de conexión ahora usará el puerto numérico correcto
    $conexion = new PDO("pgsql:host=$host;port=$port;dbname=$base_de_datos", $usuario, $contrasena);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Opcional: Solo para que sepas que funcionó al probarlo
    // echo "¡Conexión exitosa!"; 

} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
