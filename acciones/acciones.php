<?php
/*
ini_set('display_errors', 1);
error_reporting(E_ALL);
*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../config/config.php");

    // Verificar token CSRF si está implementado en el frontend
    if (isset($_POST['csrf_token'])) {
        if (!verificarCSRF($_POST['csrf_token'])) {
            http_response_code(403);
            echo json_encode(["status" => "error", "message" => "Token CSRF inválido"]);
            exit;
        }
    }

    // Capturamos los campos reales de tu tabla public.usuarios
    $usuario         = trim($_POST['usuario'] ?? '');
    $contrasena      = trim($_POST['contrasena'] ?? '');
    $nombre          = trim($_POST['nombre'] ?? '');
    $rol             = trim($_POST['rol'] ?? '');
    $cargo           = trim($_POST['cargo'] ?? '');
    $id_departamento = isset($_POST['id_departamento']) ? intval($_POST['id_departamento']) : 0;

    // Validaciones básicas
    if (empty($usuario) || empty($contrasena) || empty($nombre) || empty($rol) || empty($cargo) || $id_departamento === 0) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
        exit;
    }

    // Hashear la contraseña antes de guardarla (seguridad)
    $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);

    // Consulta adaptada a tu esquema de PostgreSQL
    $sql = "INSERT INTO public.usuarios (usuario, contrasena, nombre, rol, cargo, id_departamento) 
            VALUES (:usuario, :contrasena, :nombre, :rol, :cargo, :id_departamento)";

    try {
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':contrasena', $contrasenaHash); // Guardamos la contraseña hasheada
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':rol', $rol);
        $stmt->bindParam(':cargo', $cargo);
        $stmt->bindParam(':id_departamento', $id_departamento);

        if ($stmt->execute()) {
            // Respuesta JSON para que el frontend pueda manejarla
            header('Content-Type: application/json');
            echo json_encode(["status" => "success", "message" => "Usuario registrado correctamente"]);
        } else {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "Error al crear el registro: " . implode(", ", $stmt->errorInfo())]);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        error_log("Error al registrar usuario: " . $e->getMessage());
        echo json_encode(["status" => "error", "message" => "Error en la base de datos"]);
    }
    exit;
}

/**
 * Función para obtener todos los usuarios con su departamento
 */
function obtenerUsuarios($conexion)
{
    // Usamos un JOIN para traer el nombre del departamento y no solo el número de ID
    $sql = "SELECT u.id, u.usuario, u.nombre, u.rol, u.cargo, u.activo, d.nombre AS departamento 
            FROM public.usuarios u
            INNER JOIN public.departamentos d ON u.id_departamento = d.id 
            ORDER BY u.id ASC";

    $stmt = $conexion->query($sql);
    if (!$stmt) {
        return false;
    }
    return $stmt;
}
