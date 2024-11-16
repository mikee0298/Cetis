<?php
include 'db_connection.php'; // Archivo que establece la conexión con la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validar que la contraseña cumple con los requisitos
    if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
        die("La contraseña debe tener al menos 8 caracteres, incluir una letra mayúscula y un número.");
    }

    // Consultar la base de datos para obtener el hash de la contraseña
    $sql = "SELECT password_hash FROM Login WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($password_hash);

    if ($stmt->fetch()) {
        // Verificar la contraseña usando password_verify
        if (password_verify($password, $password_hash)) {
            echo "Inicio de sesión exitoso. ¡Bienvenido, $username!";
            // Aquí puedes iniciar una sesión o redirigir al usuario
            session_start();
            $_SESSION['username'] = $username;
            header("Location: index.html"); // Redirige al usuario después de un inicio exitoso
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "El nombre de usuario no existe.";
    }

    $stmt->close();
} else {
    echo "Método no permitido.";
}

$conn->close();
?>


