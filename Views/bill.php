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
        <a href="home.php">
            <button type="button">salir</button>
        </a>
        <a href="">
            <button type="button">Cerrar Cuenta</button>
        </a>
            
    </div>
</body>
</html>
