<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
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
                <li><a href="gestionar_material.php">Material de apoyo</a></li>
                <li class="admin-panel"><a href="admin.php">Panel de Administración</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="admin-panel-container">
            <h1>Panel de Administración</h1>
            <h2>Bienvenido, <?php echo $_SESSION['admin']; ?></h2>
            <ul class="admin-options-list">
                <li class="admin-option-card"><a href="alumno.php">Gestionar alumnos</a></li>
                <li class="admin-option-card"><a href="evaluaciones.php">Gestionar Evaluaciones</a></li>
                <li class="admin-option-card"><a href="materias.php">Gestionar Materias</a></li>
                <li class="admin-option-card"><a href="profesores.php">Gestionar Profesores</a></li>
                <li class="admin-option-card"><a href="gestionar_temas.php">Gestionar temas</a></li>
                <li class="admin-option-card"><a href="gestionar_ejercicios.php">Gestionar Ejercicios</a></li>
                <li class="admin-option-card"><a href="gestionar_material.php">Gestionar material de apoyo</a></li>
                <li class="admin-option-card"><a href="logout.php">Cerrar Sesión</a></li>
            </ul>
            <section class="intro">
                <p>
                    Explora el fascinante mundo de las matemáticas con nuestras clases, ejercicios prácticos, temas detallados y soluciones completas. ¡Aprende y domina las subáreas esenciales!
                </p>
            </section>
        </div>
    </main>
    <footer>
        <p>© 2024 Unidad Educativa Juancito Pinto</p>
    </footer>
</body>
</html>
