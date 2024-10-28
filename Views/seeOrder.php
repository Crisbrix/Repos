<?php
    // Incluir el controlador que mostrará los detalles del pedido
    include("../controllers/seeOrderC.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Kamelia - Ver Pedido</title>
    <link rel="stylesheet" href="../styles/seeOrder.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Menú de Navegación -->
    <nav>
        <ul>
            <li>
                <a><?php
                    echo $rol;
                ?></a>
            </li>
            <li><a class="link" href="table.php?action=add">Adición Pedido</a></li>
            <li><a class="link" href="table.php?action=edit">Modificar Pedido</a></li>
            <li><a class="link" href="table.php?action=close">Cerrar Cuenta</a></li>
            <li class="dropdown">
            <a href="javascript:void(0)" class="dropbtn"><?php 
                echo $name; 
            ?></a>
                <div class="dropdown-content">
                    <a href="../controllers/logout.php">Cerrar Sesión</a>
                </div>
            </li>
        </ul>
    </nav>
    <div class="container">
        <div class="header">
            <img alt="Logo La Kamelia" height="100" src="../img/logo.jpg" width="100"/>
            <h1>La Kamelia</h1>
            <h2>Restaurante</h2>
        </div>

        <div class="invoice-details">
            <p><strong>Detalles de la factura:</strong></p>
            <table class="table">
                <?php
                    // Incluir el controlador que mostrará los detalles del pedido
                    obtenerDetallesPedido($mesaId, $conn);
                    // Cerrar la conexión
                    $conn->close();
                ?>
            </table>
            <a href="home.php">
                <button type="button">Salir</button>
            </a>
        </div>
    </div>
</body>
</html>
