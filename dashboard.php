<?php
session_start();
include 'includes.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$id_usuario = $_SESSION['usuario']['id_usuario'];

$tareas = $pdo->prepare("SELECT * FROM tareas WHERE id_usuario = ?");
$tareas->execute([$id_usuario]);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mis Tareas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css_estilos.css">
</head>
<body>
<div class="container mt-5">
<marquee direction="left">UNIVERSIDAD  REGIONAL DE GUATEMALA </marquee>
    <h2>Bienvenido, <?= $_SESSION['usuario']['nombre'] ?></h2>
    <a href="asignar_tarea.php" class="btn btn-primary mb-3">Crear nueva tarea</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Vencimiento</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tareas as $t): ?>
                <tr>
                    <td><?= htmlspecialchars($t['titulo']) ?></td>
                    <td><?= htmlspecialchars($t['descripcion']) ?></td>
                    <td><?= $t['fecha_vencimiento'] ?></td>
                    <td><?= $t['estado'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<footer class="footer-derecha">
    Desarrollado por Víctor Aguilar 2350336 &copy; 2025
</footer>

</body>
</html>
