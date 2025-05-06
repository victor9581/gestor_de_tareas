<?php
$pdo = new PDO("mysql:host=localhost;dbname=gestor_tareas", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
