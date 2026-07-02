<?php
include("../config/config.php");

$fecha_actual = date("Y-m-d");
$filename = "empleados_" . $fecha_actual . ".csv";

// Encabezados para el archivo CSV
$fields = array('ID', 'Nombre', 'Edad', 'Cédula', 'Sexo', 'Teléfono', 'Cargo', 'Avatar');

// Consulta SQL para obtener los datos de los empleados
$sql = "SELECT * FROM tbl_empleados";
// Ejecutar la consulta
$stmt = $conexion->query($sql);

// Verificar si hay datos obtenidos de la consulta
if ($stmt->rowCount() > 0) {
    // Abrir el archivo CSV para escritura
    $fp = fopen('php://output', 'w');

    // Agregar los encabezados al archivo CSV
    fputcsv($fp, $fields);

    // Iterar sobre los resultados y agregar cada fila al archivo CSV
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        fputcsv($fp, $row);
    }

    // Cerrar el archivo CSV
    fclose($fp);

    // Establecer las cabeceras para descargar el archivo CSV
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    // Detener la ejecución del script para que solo se descargue el archivo CSV
    exit();
} else {
    // Si no hay datos de empleados, redireccionar o mostrar un mensaje de error
    echo "No hay empleados para generar el reporte.";
}
