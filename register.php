<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validar que el correo es válido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Por favor, ingresa un correo electrónico válido.");
    }

    // Validar que la contraseña cumple con los requisitos
    if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
        die("La contraseña debe tener al menos 8 caracteres, incluir una letra mayúscula y un número.");
    }

    // Generar el hash de la contraseña
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insertar el usuario en la base de datos
    $sql = "INSERT INTO Login (alumno_id, username, password_hash) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $alumno_id = 1; // Cambia esto según el alumno que se registre
    $stmt->bind_param("iss", $alumno_id, $email, $password_hash);

    if ($stmt->execute()) {
        echo "Cuenta creada exitosamente. <a href='login.html'>Inicia sesión</a>";
    } else {
        echo "Error al registrar el usuario: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>

