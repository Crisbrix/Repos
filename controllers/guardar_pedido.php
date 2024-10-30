<?php
include ('conexion.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Validar datos básicos
if (!isset($_POST['mesa_id'], $_POST['usuario_id'], $_POST['estado'], $_POST['productos'])) {
    echo "Datos incompletos";
    exit;
}

// Obtener datos del POST
$mesa_id = $_POST['mesa_id'];
$usuario_id = $_POST['usuario_id'];
$estado = $_POST['estado'];
$fecha_hora = date('Y-m-d H:i:s');
$productos = $_POST['productos'];


// Insertar los detalles del pedido en la tabla `detalles_pedido`
foreach ($productos as $producto) {
    $producto_id = $producto['producto_id'];
    $cantidad = $producto['cantidad'];
    $comentario = $producto['nota'] ?? ''; 
}
// Redireccionar a una página de éxito o al `home`
header("Location: ../views/home.php");
exit;
?>
