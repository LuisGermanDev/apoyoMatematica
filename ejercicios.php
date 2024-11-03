<?php
include 'conexion.php';

// Consulta para obtener todas las materias
$sql = "SELECT * FROM materias";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicios - Unidad Educativa Juancito Pinto</title>
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
        <h1>Ejercicios por Materia</h1>
        <div class="materias-container">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="materia-card">
                    <h3><a href="ver_ejercicios.php?materia_id=<?php echo $row['id']; ?>"><?php echo $row['nombre_materia']; ?></a></h3>
                </div>
            <?php endwhile; ?>
        </div>
    </main>
</body>
</html>

<?php $conn->close(); ?>
