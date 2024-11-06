<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RePOS - Entradas</title>

    <!-- Llamada al archivo CSS externo -->
    <link rel="stylesheet" href="../styles/Kitchen.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/fontStyles.css">

    <!-- Fuente de Google -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Open+Sans&display=swap">
</head>
<body>
    <nav>
        <ul>
            <li><a href="../index.php">Repos</a></li>
            <li class="dropdown">
            <a href="" class="dropbtn">Menu</a>
                <div class="dropdown-content">
                    <a href="kitchen.php">Platos Fuertes</a>
                    <a href="drink.php">Bebidas</a>
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
    <?php include("../controllers/EntryC.php"); ?>
</div>
<script src="../js/scripts.js"></script>
<script src="../js/cronometro.js"></script>
</body>
</html>
