<?php
include 'includes.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $correo, $contrasena]);

    echo "Usuario registrado con éxito.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">Registro</h2>
    <form method="POST">
        <input class="form-control mb-3" type="text" name="nombre" placeholder="Nombre completo" required>
        <input class="form-control mb-3" type="email" name="correo" placeholder="Correo" required>
        <input class="form-control mb-3" type="password" name="contrasena" placeholder="Contraseña" required>
        <button class="btn btn-primary" type="submit">Registrar</button>
    </form>
</div>
</body>
</html>
