<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $nombre = $_POST['nombre'] ?? 'Alumno'; // Nombre opcional o valor predeterminado
    $telefono = $_POST['telefono'] ?? NULL;

    // Validar correo
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Por favor, ingresa un correo electrónico válido.");
    }

    // Validar contraseña
    if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
        die("La contraseña debe tener al menos 8 caracteres, incluir una letra mayúscula y un número.");
    }

    // Validar que las contraseñas coinciden
    if ($password !== $confirm_password) {
        die("Las contraseñas no coinciden. Por favor, intenta de nuevo.");
    }

    // Generar el hash de la contraseña
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Iniciar una transacción para garantizar integridad
    $conn->begin_transaction();
    try {
        // Insertar en la tabla Alumnos
        $sql_alumno = "INSERT INTO Alumnos (nombre, email, telefono) VALUES (?, ?, ?)";
        $stmt_alumno = $conn->prepare($sql_alumno);
        $stmt_alumno->bind_param("sss", $nombre, $email, $telefono);
        $stmt_alumno->execute();
        $alumno_id = $stmt_alumno->insert_id; // Obtener el ID generado
        $stmt_alumno->close();

        // Insertar en la tabla Login
        $sql_login = "INSERT INTO Login (alumno_id, username, password_hash) VALUES (?, ?, ?)";
        $stmt_login = $conn->prepare($sql_login);
        $stmt_login->bind_param("iss", $alumno_id, $email, $password_hash);
        $stmt_login->execute();
        $stmt_login->close();

        // Confirmar la transacción
        $conn->commit();
        echo "Cuenta creada exitosamente. Redirigiendo al inicio de sesión...";
        header("refresh:3;url=login.html");
        exit();
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $conn->rollback();
        die("Error al registrar el usuario: " . $e->getMessage());
    }
}

$conn->close();
?>