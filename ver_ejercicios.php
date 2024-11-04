<?php
include 'conexion.php';

$materia_id = $_GET['materia_id'];
$sql = "SELECT * FROM ejercicios WHERE materia_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $materia_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicios</title>
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
    <h1>Ejercicios</h1>
    <div class="ejercicios-container">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="ejercicio">
                <p><?php echo $row['ejercicio']; ?></p>
                <div class="respuesta">
                    <p>Respuesta: <?php echo $row['respuesta']; ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</main>

</body>
</html>

<?php $conn->close(); ?>
