<?php
// acciones/getUsuario.php - Obtiene datos de un usuario por ID

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    include("../config/config.php");

    // Obtener y validar el ID de usuario de la solicitud GET
    $idUsuario = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    
    if ($idUsuario === false || $idUsuario === null) {
        http_response_code(400);
        echo json_encode(["error" => "ID de usuario inválido o no proporcionado"]);
        exit();
    }

    try {
        // Consulta correcta a la tabla public.usuarios
        $sql = "SELECT id, nombre, usuario, rol, cargo, id_departamento, activo 
                FROM public.usuarios 
                WHERE id = :id 
                LIMIT 1";
        
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();

        // Obtener los datos del usuario como un array asociativo
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            // Asegurar que el campo activo sea booleano para JavaScript
            $usuario['activo'] = (bool)$usuario['activo'];
            
            // Devolver los datos del usuario como JSON
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($usuario);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Usuario no encontrado"]);
        }
        
    } catch (PDOException $e) {
        http_response_code(500);
        error_log("Error al obtener usuario: " . $e->getMessage());
        echo json_encode(["error" => "Error en la base de datos"]);
    }
    
    exit;
} else {
    http_response_code(405);
    echo json_encode(["error" => "Método no permitido"]);
}
