<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Actualizar el profesor con los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $especialidad = $_POST['especialidad'];

    $sql = "UPDATE profesores SET nombre = '$nombre', apellido = '$apellido', especialidad = '$especialidad' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Profesor actualizado correctamente";
    } else {
        echo "Error al actualizar el profesor: " . $conn->error;
    }

    $conn->close();
    header("Location: profesores.php");
    exit;
} else {
    // Obtener los datos del profesor para mostrarlos en el formulario de edición
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM profesores WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "Profesor no encontrado";
            exit;
        }
    } else {
        echo "ID no especificado";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Profesor</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <h1>Editar Profesor</h1>
    </header>
    <main>
        <form action="editar-profesor.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="nombre">Nombre del Profesor:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" required>

            <label for="apellido">Apellido del Profesor:</label>
            <input type="text" id="apellido" name="apellido" value="<?php echo $row['apellido']; ?>" required>

            <label for="especialidad">Especialidad:</label>
            <input type="text" id="especialidad" name="especialidad" value="<?php echo $row['especialidad']; ?>" required>

            <input type="submit" value="Actualizar Profesor">
        </form>
    </main>
    <footer>
        <p>© 2024 Unidad Educativa Juancito Pinto</p>
    </footer>
</body>
</html>
