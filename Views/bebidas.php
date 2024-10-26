<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RePOS - Bebidas</title>
    <link rel="stylesheet" href="../styles/Kitchen.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Open+Sans&display=swap">
</head>
<body>
    <!-- Encabezado de la página -->
    <div class="header">
        <h1>RePOS</h1>
        <div class="nav-buttons">
            <div class="dropdown">
                <button class="menu-button">Menú</button>
                    <div class="dropdown-content">
                        <!-- Enlace modificado para dirigir a la página "entradas.php" -->
                        <a href="entradas.php">Entradas</a>
                        <a href="Kitchen.php">Platos Fuertes</a>
                        <a href="bebidas.php">Bebidas</a>
                    </div>
                </div>
                <a href="../views/home.php" class="salir-button">Salir</a>
        </div>
    </div>
    
    <!-- Título de la sección -->
    <strong>
        <div class="title">BEBIDAS</div>
    </strong>

    <div class="container">
    <?php include("../controllers/BebidasC.php"); ?>   

</div>
<script src="../js/scripts.js"></script>
<script src="../js/cronometro.js"></script>
</body>
</html>
