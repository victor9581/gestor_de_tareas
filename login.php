<?php
session_start();
include 'includes.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE correo = ?");
    $stmt->execute([$correo]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
        $_SESSION['usuario'] = $usuario;
        header("Location: dashboard.php");
    } else {
        $error = "Credenciales incorrectas.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css_estilos.css">
</head>
<body class="bg-light">
<div class="container mt-5">
<marquee direction="left">UNIVERSIDAD  REGIONAL DE GUATEMALA </marquee>
    <h2 class="mb-4">Iniciar sesión</h2>
    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="POST">
        <input class="form-control mb-3" type="email" name="correo" placeholder="Correo" required>
        <input class="form-control mb-3" type="password" name="contrasena" placeholder="Contraseña" required>
        <button class="btn btn-success" type="submit">Ingresar</button>
    </form>
</div>
<footer class="footer-derecha">
    Desarrollado por Víctor Aguilar 2350336 &copy; 2025
</footer>

</body>
</html>
