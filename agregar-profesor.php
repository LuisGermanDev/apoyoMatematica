<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $especialidad = $_POST['especialidad'];

    // Inserción en la tabla profesores
    $sql = "INSERT INTO profesores (nombre, apellido, especialidad) VALUES ('$nombre', '$apellido', '$especialidad')";

    if ($conn->query($sql) === TRUE) {
        echo "Profesor agregado correctamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
