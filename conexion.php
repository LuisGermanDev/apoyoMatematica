<?php
$host = 'localhost:3307';
$db = 'unidad_educativa';
$user = 'root';
$pass = '';

// Crear conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
