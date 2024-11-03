<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM alumnos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $alumno = $result->fetch_assoc();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $edad = $_POST['edad'];
    $grado = $_POST['grado'];

    $sql = "UPDATE alumnos SET nombre = ?, apellido = ?, edad = ?, grado = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisi", $nombre, $apellido, $edad, $grado, $id);

    if ($stmt->execute()) {
        header("Location: alumno.php?mensaje=Alumno actualizado correctamente");
    } else {
        echo "Error al actualizar el alumno.";
    }

    $stmt->close();
    $conn->close();
    exit;
} else {
    header("Location: alumno.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Alumno</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <main>
        <h2>Editar Alumno</h2>
        <form action="editar-alumno.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $alumno['id']; ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $alumno['nombre']; ?>" required>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="<?php echo $alumno['apellido']; ?>" required>

            <label for="edad">Edad:</label>
            <input type="number" id="edad" name="edad" value="<?php echo $alumno['edad']; ?>" required>

            <label for="grado">Grado:</label>
            <input type="text" id="grado" name="grado" value="<?php echo $alumno['grado']; ?>" required>

            <input type="submit" value="Guardar Cambios">
        </form>
    </main>
</body>
</html>
