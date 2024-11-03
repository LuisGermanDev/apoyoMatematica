<?php
include 'conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <nav>
            <ul class="navbar">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="clases.php">Clases</a></li>
                <li><a href="ejercicios.php">Ejercicios</a></li>
                <li><a href="notas.php">Notas</a></li>
                <li><a href="materialDeApoyo.php">Material de apoyo</a></li>
                <li class="admin-panel"><a href="admin.php">Panel de Administración</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Panel de Administración</h1>

        <!-- Mostrar mensajes de error o éxito -->
        <?php if (isset($_GET['error'])): ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php endif; ?>

        <?php if (isset($_GET['mensaje'])): ?>
            <p class="mensaje"><?php echo $_GET['mensaje']; ?></p>
        <?php endif; ?>

        <h2>Administrar Alumnos y Evaluaciones</h2>
        <form action="agregar-datos.php" method="POST">
            <label for="nombre">Nombre del Alumno:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="apellido">Apellido del Alumno:</label>
            <input type="text" id="apellido" name="apellido" required>

            <label for="edad">Edad:</label>
            <input type="number" id="edad" name="edad" required>

            <label for="grado">Grado:</label>
            <input type="text" id="grado" name="grado" required>

            <input type="submit" value="Agregar Alumno">
        </form>

        <h2>Lista de Alumnos</h2>
        <?php
        $sql = "SELECT * FROM alumnos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table><tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Edad</th><th>Grado</th><th>Opciones</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["nombre"] . "</td>
                        <td>" . $row["apellido"] . "</td>
                        <td>" . $row["edad"] . "</td>
                        <td>" . $row["grado"] . "</td>
                        <td>
                            <a href='editar-alumno.php?id=" . $row["id"] . "'>Editar</a> 
                            <a href='eliminar-alumno.php?id=" . $row["id"] . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este alumno?\");'>Eliminar</a>
                        </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "No hay alumnos registrados.";
        }

        $conn->close();
        ?>
    </main>
    <footer>
        <p>© 2024 Unidad Educativa Juancito Pinto</p>
    </footer>
</body>
</html>
