<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_materia = $_POST['nombre_materia'];
    $descripcion = $_POST['descripcion'];

    $sql = "INSERT INTO materias (nombre_materia, descripcion) VALUES ('$nombre_materia', '$descripcion')";

    if ($conn->query($sql) === TRUE) {
        echo "Materia agregada correctamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
