<?php
include("conexion.php"); // Conectar con la base de datos
include("../funtions/seeOrderF.php"); // Incluir el archivo con la función

session_start();

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['userid'])) {
    $userId = $_SESSION['userid'];  
} else {
    header("Location: ../index.php");
    exit();
}

// Consulta SQL para verificar las credenciales del usuario
$sql = "SELECT nombre, rol FROM usuarios WHERE usuario_id = '$userId'";
$result = $conn->query($sql);

$row = $result->fetch_assoc();
$name = ucfirst($row["nombre"]);
$rol = ucfirst($row["rol"]);

// Verificar si la mesa ha sido seleccionada
if (isset($_SESSION['mesaId'])) {
    $mesaId = $_SESSION['mesaId'];  
} else {
    header("Location: ../index.php");
    exit();
}

// Llamar a la función para obtener los detalles del pedido
// obtenerDetallesPedido($mesaId, $conn);
?>
