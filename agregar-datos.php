<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $edad = $_POST['edad'];
    $grado = $_POST['grado'];

    $sql = "INSERT INTO alumnos (nombre, apellido, edad, grado) VALUES ('$nombre', '$apellido', '$edad', '$grado')";

    if ($conn->query($sql) === TRUE) {
        header("Location: alumno.php?mensaje=alumno_agregado");

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
