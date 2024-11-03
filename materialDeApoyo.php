<?php
include 'conexion.php';

// Consulta para obtener el material de apoyo junto con el nombre de la materia
$sql = "SELECT material_apoyo.titulo, material_apoyo.enlace, materias.nombre_materia 
        FROM material_apoyo
        JOIN materias ON material_apoyo.materia_id = materias.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Material de Apoyo - Unidad Educativa Juancito Pinto</title>
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
        <h1>Material de Apoyo</h1>
        
        <?php if ($result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Título</th>
                    <th>Materia</th>
                    <th>Enlace</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['titulo']; ?></td>
                        <td><?php echo $row['nombre_materia']; ?></td>
                        <td><a href="<?php echo $row['enlace']; ?>" target="_blank">Ver recurso</a></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No hay material de apoyo disponible.</p>
        <?php endif; ?>

    </main>

    <footer>
        <p>© 2024 Unidad Educativa Juancito Pinto</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
