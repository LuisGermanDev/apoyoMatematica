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
    <link rel="stylesheet" href="estilos1.css">
</head>
<body>
    <header>
        <h1>Panel de Administración</h1>
    </header>
    <main>
        <h2>Bienvenido, <?php echo $_SESSION['admin']; ?></h2>
        <ul>
            <li><a href="alumno.php">Gestionar alumnos</a></li>
            <li><a href="evaluaciones.php">Gestionar Evaluaciones</a></li>
            <li><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
        <section class="intro">
            <p>
                Explora el fascinante mundo de las matemáticas con nuestras clases, ejercicios prácticos, temas detallados y soluciones completas. ¡Aprende y domina las subáreas esenciales!
            </p>
        </section>
      
        <section class="categories">
            <h2>Categorías de Matemáticas</h2>
            <div class="category">
                <h3>Clases</h3>
                <ul>
                    <li>Álgebra</li>
                
                    <li>Geometría</li>
                    <li>Trigonometría</li>
                    <li>Cálculo</li>
                </ul>
            </div>

            <div class="category">
                <h3>Ejercicios</h3>
                <ul>
                    <li>Problemas de Álgebra</li>
                    <li>Ejercicios de Geometría</li>
                    <li>Problemas de Trigonometría</li>
                    <li>Ejercicios de Cálculo</li>
                </ul>
            </div>

            <div class="category">
                <h3>Temas </h3>
                <ul>
                    <li>Expresiones Algebraicas</li>
                    <li>Teoremas Geométricos</li>
                    <li>Identidades Trigonométricas</li>
                    <li>Límites y Derivadas</li>
                </ul>
            </div>

            <div class="category">
                <h3>Soluciones</h3>
                <ul>
                    <li>Álgebra: Soluciones detalladas</li>
                    <li>Geometría: Explicaciones paso a paso</li>
                    <li>Trigonometría: Ejemplos resueltos</li>
                    <li>Cálculo: Soluciones a problemas avanzados</li>
                </ul>
            </div>
        </section>
    </main>
    <footer>
        <p>© 2024 Unidad Educativa Juancito Pinto</p>
    </footer>
</body>
</html>
-