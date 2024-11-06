<?php
    session_start();

    include("conexion.php");
    include ("../funtions/seeOrderF.php");

    $pedidoId = 0;
    if (isset($_SESSION['mesaId'])) {
        $mesa = $_SESSION['mesaId']; 
    }

    if (isset($_SESSION['userid'])) {
        $userId = $_SESSION['userid'];  
    } else {
        header("Location: ../index.php");
    } 

    obtenerDetallesPedido($mesa, $conn);

    // Manejo del cierre de cuenta
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cerrar_cuenta'])) {
        // 1. Actualiza el estado del pedido a 'pagado'
        $sqlUpdate = "UPDATE pedidos SET estado = 'pagado' WHERE pedido_id = $pedidoId";
        $result = $conn->query($sqlUpdate);
        if ($conn->query($sqlUpdate) === TRUE) {
            // 2. Realiza la eliminación de los registros relacionados
            $sqlDelete = "DELETE FROM DetallePedido WHERE pedido_id = $pedidoId;
                        DELETE FROM Facturas WHERE pedido_id = $pedidoId;
                        DELETE FROM Notificaciones WHERE pedido_id = $pedidoId;
                        DELETE FROM Pedidos WHERE pedido_id = $pedidoId;
                        DELETE FROM Mesas WHERE mesa_id = $mesa";
            
            if ($conn->multi_query($sqlDelete)) {
                // Redirigir a la página principal una vez que la cuenta ha sido cerrada
                header("Location: ../Views/home.php");
                exit();
            } else {
                echo "Error al eliminar los registros relacionados: " . $conn->error;
            }
        } else {
            echo "Error al actualizar el estado del pedido: " . $conn->error;
        }
    }

    // Cerrar la conexión
    $conn->close();
?>