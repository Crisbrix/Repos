<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista de Cocina</title>
    <link rel="stylesheet" href="../styles/Kitchen.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/fontStyles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Open+Sans&display=swap">
</head>
<body>
    <nav>
        <ul>
            <li><a href="../index.php">Repos</a></li>
            <li class="dropdown">
            <a href="" class="dropbtn">Menu</a>
                <div class="dropdown-content">
                    <a href="Entry.php">Entradas</a>
                    <a href="drink.php">Bebidas</a>
                    <a href="../index.php">Salir</a>
                </div>
            </li>
        </ul>
    </nav>

    <strong>
        <div class="title">PLATOS FUERTES</div>
    </strong>

    <div class="container">
        <?php 
        // Incluir el archivo que maneja la lógica de los pedidos
        include("../controllers/KitchenC.php"); 
        ?>  

        
    <script src="../js/scripts.js"></script>
    <script src="../js/cronometro.js"></script>
    </div>
</body>
</html>