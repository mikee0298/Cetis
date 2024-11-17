<?php
include 'db_connection.php'; // Archivo que establece la conexión con la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validar que el correo tiene un formato válido
    if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        die("Por favor, ingresa un correo electrónico válido.");
    }

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
            echo "Inicio de sesión exitoso. ¡Bienvenido!";
            // Aquí puedes iniciar una sesión o redirigir al usuario
            session_start();
            $_SESSION['username'] = $username;
            header("Location: index.html");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        // Si no existe el correo, mostrar mensaje con enlace a registro
        echo "El correo no está registrado. <a href='register.php'>Crear una cuenta</a>";
    }

    $stmt->close();
} else {
    echo "Método no permitido.";
}

$conn->close();
?>


