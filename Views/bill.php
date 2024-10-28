<!DOCTYPE html>
<html lang="es">
<head>
    <title>Factura</title>
    <link rel="stylesheet" href="../styles/bill.css">
    <link rel="stylesheet" href="../styles/fontStyles.css">
</head>
<body>
    <h1>Factura</h1>
    <div class="table-container">
        <table>
            <?php
                include("../controllers/billC.php");
            ?>
        </table>
        <!-- Formulario corregido -->
        <form method="POST" action="../controllers/billC.php">
            <!-- Botón para salir -->
            <a href="home.php">
                <button type="button">Salir</button>
            </a>
            <!-- Botón para cerrar cuenta (acción de enviar formulario) -->
            <button type="submit" name="cerrar_cuenta">Cerrar Cuenta</button>
        </form>            
    </div>
</body>
</html>