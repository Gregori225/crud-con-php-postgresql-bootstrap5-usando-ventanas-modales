<?php
// Configuración de la base de datos usando variables de entorno para mayor seguridad
// Si no existen las variables de entorno, se usan valores por defecto (solo para desarrollo)
$host = getenv('DB_HOST') ?: "localhost";
$port = getenv('DB_PORT') ?: "5432";
$usuario = getenv('DB_USER') ?: "postgres";
$contrasena = getenv('DB_PASSWORD') ?: "";
$base_de_datos = getenv('DB_NAME') ?: "INFORMESV1";

// Token CSRF para protección contra ataques Cross-Site Request Forgery
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

try {
    // La cadena de conexión ahora usará el puerto numérico correcto
    $conexion = new PDO("pgsql:host=$host;port=$port;dbname=$base_de_datos", $usuario, $contrasena);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Opcional: Solo para que sepas que funcionó al probarlo
    // echo "¡Conexión exitosa!"; 

} catch (PDOException $e) {
    // En producción, registrar el error en un log en lugar de mostrarlo
    error_log("Error de conexión a la base de datos: " . $e->getMessage());
    http_response_code(500);
    die("Error de conexión a la base de datos. Por favor, contacte al administrador.");
}

/**
 * Función para verificar el token CSRF
 * @param string $token El token a verificar
 * @return bool Verdadero si el token es válido, falso en caso contrario
 */
function verificarCSRF($token) {
    if (!isset($_SESSION['csrf_token'])) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Función para obtener el token CSRF actual
 * @return string El token CSRF
 */
function getCSRFToken() {
    return $_SESSION['csrf_token'] ?? '';
}
