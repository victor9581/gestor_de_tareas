<?php
session_start();
include 'includes.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_SESSION['usuario']['id_usuario'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha_vencimiento'];

    $stmt = $pdo->prepare("INSERT INTO tareas (id_usuario, titulo, descripcion, fecha_vencimiento) VALUES (?, ?, ?, ?)");
    $stmt->execute([$id_usuario, $titulo, $descripcion, $fecha]);

    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Asignar tarea</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css_estilos.css">
    
</head>
<body>
<div class="container mt-5">
<marquee direction="left">UNIVERSIDAD  REGIONAL DE GUATEMALA </marquee>
    <h2>Crear nueva tarea</h2>
    <form method="POST">
        <input class="form-control mb-3" type="text" name="titulo" placeholder="Título de la tarea" required>
        <textarea class="form-control mb-3" name="descripcion" placeholder="Descripción" required></textarea>
        <input class="form-control mb-3" type="date" name="fecha_vencimiento" required>
        <button class="btn btn-success" type="submit">Guardar tarea</button>
    </form>
</div>
<footer class="footer-derecha">
    Desarrollado por Víctor Aguilar 2350336 &copy; 2025
</footer>

</body>
</html>
