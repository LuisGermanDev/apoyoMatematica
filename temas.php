<?php
include 'conexion.php';

$materia_id = $_GET['materia_id'];

// Consulta para obtener los temas de la materia seleccionada
$sql = "SELECT titulo_tema, contenido, imagen_url FROM temas WHERE materia_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $materia_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Temas</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <nav>
            <ul class="navbar">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="clases.php">Clases</a></li>
                <li><a href="contact.php">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Temas de la Materia Seleccionada</h2>
        <div class="cards-container">
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="card">
                        <h3><?php echo $row["titulo_tema"]; ?></h3>
                        <p><?php echo $row["contenido"]; ?></p>
                        <?php if (!empty($row["imagen_url"])): ?>
                            <img src="<?php echo $row["imagen_url"]; ?>" alt="Imagen del tema">
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No hay temas disponibles para esta materia.</p>
            <?php endif; ?>
        </div>
    </main>

    <?php $conn->close(); ?>
</body>
</html>
