<?php
session_start(); // iniciar la sesión
include("conexion.php");

//Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    // Consulta SQL para verificar las credenciales del usuario
    $sql = "SELECT id_usuario, nombre, rol FROM usuarios WHERE correo = '$user' AND password = '$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        //Inicio de sesión exitoso
        $row = $result->fetch_assoc();
        $userId = $row['id_usuario'];

        //Almacenar el ID del usuario en la sesión
        $_SESSION['userid'] = $userId;

        $rol = $row['rol'];
        //Almacenar el rol en la sesión
        $_SESSION['rol'] = $rol;

        //Redirigir a la página de éxito
        header("Location: ../Views/home.php");
        exit();
    } else {
        //Credenciales incorrectas
        echo "
            <div class='error-message'>
                <p>⚠️ Error: Usuario o contraseña incorrectos. Por favor, inténtalo de nuevo.</p>
            </div>
        
        <style>
            .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px 20px;
            border-radius: 5px;
            font-family: Arial, sans-serif;
            font-size: 16px;
            width: 100%;
            max-width: 400px;
            margin: 20px auto;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .error-message p {
            margin: 0;
        }
        </style>";
    }
}

//Cerrar la conexión a la base de datos
$conn->close();
?>