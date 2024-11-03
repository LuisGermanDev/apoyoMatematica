<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_alumno = $_POST['id_alumno'];
    $id_materia = $_POST['id_materia'];
    $nota = $_POST['nota'];
    $fecha = $_POST['fecha'];

    $sql = "INSERT INTO evaluaciones (id_alumno, id_materia, nota, fecha) VALUES ('$id_alumno', '$id_materia', '$nota', '$fecha')";

    if ($conn->query($sql) === TRUE) {
        header("Location: evaluaciones.php?mensaje=evaluacion_agregado");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
