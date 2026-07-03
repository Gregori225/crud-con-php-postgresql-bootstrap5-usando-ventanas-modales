<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD de Usuarios en PHP, PostgreSQL utilizando MODALES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="assets/css/home.css">
</head>

<body>
    <?php
    // Asegúrate de que config.php tenga tu conexión PDO a Postgres que reparamos antes
    include("config/config.php");
    include("acciones/acciones.php");

    // Cambiamos la función a obtenerUsuarios para que sea semánticamente correcto
    $usuarios = obtenerUsuarios($conexion);
    $totalUsuarios = $usuarios->rowCount();
    ?>

    <h1 class="text-center mt-5 mb-5 fw-bold">CRUD completo de Usuarios con PHP, PostgreSQL y Bootstrap 5</h1>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <h1 class="text-center">
                    <span class="float-start">
                        <a href="#" onclick="modalRegistrarEmpleado()" class="btn btn-success" title="Registrar Nuevo Usuario">
                            <i class="bi bi-person-plus"></i>
                        </a>
                    </span>
                    Lista de usuarios (<?php echo $totalUsuarios ?>)
                    <span class="float-end">
                        <a href="acciones/exportarCSV.php" class="btn btn-success" title="Exportar a CSV">
                            <i class="bi bi-filetype-csv"></i>
                        </a>
                    </span>
                    <hr>
                </h1>

                <div class="row mb-3 justify-content-end">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" id="inputBuscar" class="form-control" placeholder="Buscar por nombre, cargo, rol...">
                        </div>
                    </div>
                </div>

                <!-- 🖱️ CONTENEDOR CON SCROLL PARA EL RATÓN -->
                <!-- Puedes cambiar el 'max-height: 400px' por la altura que más te guste -->
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto; border: 1px solid #dee2e6; border-radius: 8px;">
                    <?php
                    // Renombra tu archivo 'empleados.php' a 'usuarios.php' para mantener el orden
                    include("usuarios.php");
                    ?>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <!-- NOTA: Dejé los nombres de los scripts JS del proyecto original para que no se rompa nada por ahora, -->
        <!-- pero internamente los iremos adaptando a tus usuarios. -->
        <script src="assets/js/detallesEmpleado.js"></script>
        <script src="assets/js/addEmpleado.js"></script>
        <script src="assets/js/editarEmpleado.js"></script>
        <script src="assets/js/eliminarEmpleado.js"></script>
        <script src="assets/js/refreshTableAdd.js"></script>
        <script src="assets/js/refreshTableEdit.js"></script>
        <script src="assets/js/buscarUsuario.js"></script>

        <!-- Libreria para alertas -->
        <script src="https://unpkg.com/nextjs-toast-notify@latest/dist/nextjs-toast-notify.min.js"></script>

</body>

</html>