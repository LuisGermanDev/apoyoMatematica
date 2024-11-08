<?php
include 'conexion.php';

// Consulta para obtener los tres mejores alumnos por cada materia
$sql = "
SELECT * FROM (
    SELECT 
        evaluaciones.nota,
        evaluaciones.fecha,
        alumnos.nombre AS nombre_alumno,
        alumnos.apellido AS apellido_alumno,
        materias.nombre_materia,
        ROW_NUMBER() OVER (PARTITION BY materias.id ORDER BY evaluaciones.nota DESC) AS ranking
    FROM evaluaciones
    JOIN alumnos ON evaluaciones.id_alumno = alumnos.id
    JOIN materias ON evaluaciones.id_materia = materias.id
) AS ranked
WHERE ranking <= 3
ORDER BY nombre_materia, ranking;
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Notas - Unidad Educativa Juancito Pinto</title>
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
        <h1>Evaluaciones y Notas</h1>
        <h2>Mejores Evaluaciones por Materia</h2>
        
        <?php if ($result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Alumno</th>
                    <th>Materia</th>
                    <th>Nota</th>
                    <th>Fecha</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['nombre_alumno'] . " " . $row['apellido_alumno']; ?></td>
                        <td><?php echo $row['nombre_materia']; ?></td>
                        <td><?php echo $row['nota']; ?></td>
                        <td><?php echo $row['fecha']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No hay evaluaciones registradas.</p>
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
