<?php
include("../config/config.php");

$id = $_GET['id'];

try {
    $sql = "DELETE FROM departamentos WHERE id = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    echo json_encode(['success' => true, 'message' => 'Departamento eliminado.']);
} catch (PDOException $e) {
    // El código 23503 en Postgres significa "Violación de llave foránea"
    if ($e->getCode() == '23503') {
        // Le decimos a Axios que la petición es inválida (Error 400), no que el servidor colapsó
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'No se puede eliminar: Existen usuarios asignados a este departamento.'
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error al eliminar el departamento.']);
    }
}
