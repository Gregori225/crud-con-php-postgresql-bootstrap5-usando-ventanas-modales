<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    include("../config/config.php");

    // Obtener el ID de empleado de la solicitud GET y asegurarse de que sea un entero
    $IdEmpleado = (int)$_GET['id'];

    // Realizar la consulta para obtener los detalles del empleado con el ID proporcionado
    $sql = "SELECT * FROM tbl_empleados WHERE id = :id LIMIT 1";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $IdEmpleado, PDO::PARAM_INT);
    $stmt->execute();

    // Verificar si la consulta se ejecutó correctamente
    if (!$stmt) {
        // Manejar el error aquí si la consulta no se ejecuta correctamente
        echo json_encode(["error" => "Error al obtener los detalles del empleado: " . implode(", ", $conexion->errorInfo())]);
        exit();
    }

    // Obtener los detalles del empleado como un array asociativo
    $empleado = $stmt->fetch(PDO::FETCH_ASSOC);

    // Devolver los detalles del empleado como un objeto JSON
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($empleado);
    exit;
}
