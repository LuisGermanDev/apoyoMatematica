<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT * FROM administradores WHERE usuario='$usuario' AND contrasena='$contrasena'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['admin'] = $usuario;
        header("Location: admin.php");
    } else {
        echo "Usuario o contraseña incorrectos";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <h1>Iniciar Sesión - Administrador</h1>
    </header>
    <main>
        <form action="login.php" method="POST">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required>
            
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <input type="submit" value="Iniciar Sesión">
        </form>
    </main>
</body>
</html>
