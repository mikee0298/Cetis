<?php
$servername = "localhost";
$username = "usuario_mysql";
$password = "contraseña_mysql";
$dbname = "CETIA148";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
