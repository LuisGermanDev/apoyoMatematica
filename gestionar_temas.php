<?php 
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Temas</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
    <nav>
        <ul class="navbar">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="clases.php">Clases</a></li>
            <li><a href="ejercicios.php">Ejecicios</a></li>
            <li><a href="notas.php">Notas</a></li>
            <li><a href="contact.php">Material de apoyo</a></li>


            <li class="admin-panel"><a href="admin.php">Panel de Administración</a></li>
        </ul>
    </nav>
    </header>

    <main>
        <h1>Gestionar Temas</h1>
        <h2>Agregar Nuevo Tema</h2>
        <form action="agregar-tema.php" method="POST">
            <label for="titulo_tema">Título del Tema:</label>
            <input type="text" id="titulo_tema" name="titulo_tema" required>

            <label for="contenido">Contenido:</label>
            <textarea id="contenido" name="contenido" required></textarea>

            <label for="imagen_url">URL de la Imagen:</label>
            <input type="text" id="imagen_url" name="imagen_url">

            <label for="materia_id">Materia:</label>
            <select id="materia_id" name="materia_id" required>
                <?php
                $sql = "SELECT id, nombre_materia FROM materias";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['nombre_materia'] . "</option>";
                }
                ?>
            </select>

            <input type="submit" value="Agregar Tema">
        </form>

        <h2>Lista de Temas</h2>
        
        <?php
        // Consulta para obtener todos los temas sin ningún filtro
        $sql = "SELECT temas.id, temas.titulo_tema, temas.contenido, materias.nombre_materia 
                FROM temas 
                JOIN materias ON temas.materia_id = materias.id";
        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table><tr><th>Título del Tema</th><th>Materia</th><th>Contenido</th><th>Acciones</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["titulo_tema"] . "</td>";
                echo "<td>" . $row["nombre_materia"] . "</td>";
                echo "<td>" . substr($row["contenido"], 0, 100) . "...</td>"; // Muestra solo las primeras 100 letras del contenido
                echo "<td>
                        <a href='editar-tema.php?id=" . $row["id"] . "'>Editar</a> | 
                        <a href='eliminar-tema.php?id=" . $row["id"] . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este tema?\");'>Eliminar</a>
                      </td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No hay temas registrados.</p>";
        }

        $conn->close();
        ?>
    </main>
</body>
</html>
