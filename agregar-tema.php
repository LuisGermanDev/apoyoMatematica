<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';

$titulo_tema = $_POST['titulo_tema'];
$contenido = $_POST['contenido'];
$imagen_url = $_POST['imagen_url'];
$materia_id = $_POST['materia_id'];

$sql = "INSERT INTO temas (titulo_tema, contenido, imagen_url, materia_id) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $titulo_tema, $contenido, $imagen_url, $materia_id);

if ($stmt->execute()) {
    echo "Tema agregado exitosamente.";
} else {
    echo "Error al agregar el tema: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
