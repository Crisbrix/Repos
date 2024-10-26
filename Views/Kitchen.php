<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista de Cocina</title>
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
                    <a href="entradas.php">Entradas</a>
                    <a href="Kitchen.php">Platos Fuertes</a>
                    <a href="bebidas.php">Bebidas</a>
                </div>
            </div>
            <a href="../views/home.php" class="salir-button">Salir</a>
        </div>
    </div>

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