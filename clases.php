<?php
$host = 'localhost:3307';
$db = 'unidad_educativa';
$user = 'root';
$pass = '';

// Conexión a la base de datos
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener las materias
$sql = "SELECT id, nombre_materia, descripcion FROM materias";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clases</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
    <nav>
        <ul class="navbar">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="clases.php">Clases</a></li>
            <li><a href="contact.php">Ejecicios</a></li>
            <li><a href="notas.php">Notas</a></li>
            <li><a href="contact.php">Material de apoyo</a></li>


            <li class="admin-panel"><a href="admin.php">Panel de Administración</a></li>
        </ul>
    </nav>
    </header>

    <main>
        <h2>Materias Disponibles</h2>
        <div class="cards-container">
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="card">
                        <h3><a href="temas.php?materia_id=<?php echo $row["id"]; ?>"><?php echo $row["nombre_materia"]; ?></a></h3>
                        <p><?php echo $row["descripcion"]; ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No hay materias disponibles.</p>
            <?php endif; ?>
        </div>
    </main>

    <?php $conn->close(); ?>
</body>
</html>
