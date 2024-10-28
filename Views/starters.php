<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RePOS - Entradas</title>

    <!-- Llamada al archivo CSS externo -->
    <link rel="stylesheet" href="../styles/Kitchen.css">
    <link rel="stylesheet" href="../styles/fontStyles.css">
    <link rel="stylesheet" href="../styles/styles.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Open+Sans&display=swap">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Lilita+One&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <ul>        
            <li><p class="tittle">Repos</p></li>
            <li class="dropdown">
            <a href="starters.php" class="dropbtn">Menú</a>
                <div class="dropdown-content">
                    <a href="starters.php">Entradas</a>
                    <a href="Kitchen.php">Platos Fuertes</a>
                    <a href="drinks.php">Bebidas</a>
                    <a href="../index.php">Salir</a>
                </div>
            </li>
        </ul>
    </nav>
    
    <!-- Título de la sección -->
    <strong>
        <div class="title">ENTRADAS</div>
    </strong>

    <!-- Contenedor principal para las tarjetas -->
    <div class="container">
    <?php include("../controllers/EntradasC.php"); ?>
</div>
<script src="../js/scripts.js"></script>
<script src="../js/cronometro.js"></script>
</body>
</html>
