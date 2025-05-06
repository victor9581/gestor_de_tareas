<?php
include 'includes.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] != "POST") {
    $num1 = rand(1, 10);
    $num2 = rand(1, 10);
    $_SESSION['captcha_resultado'] = $num1 + $num2;
    $_SESSION['captcha_pregunta'] = "$num1 + $num2";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (!isset($_POST['captcha_usuario']) || $_POST['captcha_usuario'] != $_SESSION['captcha_resultado']) {
        echo "<div class='alert alert-danger text-center'>Captcha incorrecto. Intenta de nuevo.</div>";
    } else {
        
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)");
        $stmt->execute([$nombre, $correo, $contrasena]);

        echo "<div class='alert alert-success text-center'>Usuario registrado con éxito.</div>";
        header("Refresh: 2; URL=login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css_estilos.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <marquee direction="left">UNIVERSIDAD  REGIONAL DE GUATEMALA </marquee>
    <h2 class="mb-4">Registro de usuario</h2>
    <form method="POST">
        <input class="form-control mb-3" type="text" name="nombre" placeholder="Nombre completo" required>
        <input class="form-control mb-3" type="email" name="correo" placeholder="Correo" required>
        <input class="form-control mb-3" type="password" name="contrasena" placeholder="Contraseña" required>

        <!-- Campo CAPTCHA -->
        <label for="captcha_usuario" class="form-label">¿Cuánto es <?= $_SESSION['captcha_pregunta'] ?>?</label>
        <input class="form-control mb-3" type="number" name="captcha_usuario" placeholder="Resultado" required>

        <button class="btn btn-primary" type="submit">Registrar</button>
    </form>
</div>
<footer class="footer-derecha">
    Desarrollado por Víctor Aguilar 2350336 &copy; 2025
</footer>

</body>
</html>
