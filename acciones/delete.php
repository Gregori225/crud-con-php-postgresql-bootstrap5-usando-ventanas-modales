<?php
// acciones/delete.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../config/config.php");

    // Leemos el cuerpo de la solicitud enviado por Axios
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

    // Verificar token CSRF si está presente
    if (isset($data['csrf_token']) && !verificarCSRF($data['csrf_token'])) {
        http_response_code(403);
        header('Content-Type: application/json');
        echo json_encode(array("success" => false, "message" => "Token CSRF inválido"));
        exit;
    }

    // Verificamos si los datos se decodificaron correctamente
    if ($data !== null && isset($data['id'])) {
        $id = intval($data['id']); // Aseguramos que sea un número entero
        
        // Validar que el ID sea positivo
        if ($id <= 0) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(array("success" => false, "message" => "ID de usuario inválido"));
            exit;
        }

        try {
            // Apuntamos a tu tabla real en PostgreSQL
            $sql = "DELETE FROM public.usuarios WHERE id = :id";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                // Verificar si realmente se eliminó alguna fila
                if ($stmt->rowCount() > 0) {
                    header('Content-Type: application/json');
                    echo json_encode(array("success" => true, "message" => "Usuario eliminado correctamente"));
                } else {
                    http_response_code(404);
                    header('Content-Type: application/json');
                    echo json_encode(array("success" => false, "message" => "Usuario no encontrado"));
                }
            } else {
                header('Content-Type: application/json');
                echo json_encode(array("success" => false, "message" => "No se pudo ejecutar la eliminación en la base de datos"));
            }
        } catch (PDOException $e) {
            // Captura errores por si el usuario está amarrado a otra tabla por clave foránea
            http_response_code(500);
            error_log("Error al eliminar usuario: " . $e->getMessage());
            header('Content-Type: application/json');
            echo json_encode(array("success" => false, "message" => "Error de base de datos. El usuario podría estar relacionado con otros registros."));
        }
    } else {
        header('Content-Type: application/json');
        echo json_encode(array("success" => false, "message" => "El parámetro 'id' no fue proporcionado o el JSON es inválido"));
    }
} else {
    http_response_code(405);
    echo "Método no permitido";
}
