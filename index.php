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
                        <!-- Cambiado a modalRegistrarUsuario() para tu nueva lógica -->
                        <a href="#" onclick="modalRegistrarEmpleado()" class="btn btn-success" title="Registrar Nuevo Usuario">
                            <i class="bi bi-person-plus"></i>
                        </a>
                    </span>
                    Lista de usuarios (<?php echo $totalUsuarios ?>)
                    <span class="float-end">
                        <a href="acciones/exportar.php" class="btn btn-success" title="Exportar a CSV" download="usuarios.csv"><i class="bi bi-filetype-csv"></i></a>
                    </span>
                    <hr>
                </h1>
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

    <!-- Libreria para alertas -->
    <script src="https://unpkg.com/nextjs-toast-notify@latest/dist/nextjs-toast-notify.min.js"></script>

</body>

</html>