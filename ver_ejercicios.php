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
    <style>
        .flip-card {
            background-color: transparent;
            perspective: 1000px;
        }
        .flip-card-inner {
            position: relative;
            width: 100%;
            transform-style: preserve-3d;
            transition: transform 0.6s;
        }
        .flip-card:hover .flip-card-inner {
            transform: rotateY(180deg);
        }
        .flip-card-front, .flip-card-back {
            position: absolute;
            width: 100%;
            backface-visibility: hidden;
        }
        .flip-card-back {
            transform: rotateY(180deg);
        }
    </style>
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
        <h1>Ejercicios</h1>
        <div class="ejercicios-container">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <p><?php echo $row['ejercicio']; ?></p>
                        </div>
                        <div class="flip-card-back">
                            <p>Respuesta: <?php echo $row['respuesta']; ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </main>
</body>
</html>

<?php $conn->close(); ?>
