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
    <title>Gestionar Material de Apoyo</title>
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
        <h1>Gestionar Material de Apoyo</h1>
        
        <!-- Formulario para agregar nuevo material -->
        <h2>Agregar Nuevo Material</h2>
        <form action="agregar-material.php" method="POST">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>

            <label for="enlace">Enlace:</label>
            <input type="url" id="enlace" name="enlace" required>

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

            <input type="submit" value="Agregar Material">
        </form>

        <!-- Lista de material de apoyo existente -->
        <h2>Lista de Material de Apoyo</h2>
        <?php
        $sql = "SELECT material_apoyo.id, material_apoyo.titulo, material_apoyo.enlace, materias.nombre_materia 
                FROM material_apoyo
                JOIN materias ON material_apoyo.materia_id = materias.id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Título</th>
                    <th>Materia</th>
                    <th>Enlace</th>
                    <th>Acciones</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['titulo']; ?></td>
                        <td><?php echo $row['nombre_materia']; ?></td>
                        <td><a href="<?php echo $row['enlace']; ?>" target="_blank">Ver recurso</a></td>
                        <td>
                            <a href="editar-material.php?id=<?php echo $row['id']; ?>">Editar</a> 
                            <a href="eliminar-material.php?id=<?php echo $row['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este material?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No hay material de apoyo registrado.</p>
        <?php endif; ?>

    </main>
</body>
</html>

<?php
$conn->close();
?>
