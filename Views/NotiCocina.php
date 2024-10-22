<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RePOS - Platos Fuertes</title>

    <!-- Llamada al archivo CSS externo -->
    <link rel="stylesheet" href="..\styles\styles.css">

    <!-- Fuente de Google -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Open+Sans&display=swap">
</head>
<body>
    <!-- Encabezado de la página -->
    <div class="header">
        <h1>RePOS</h1>
        <div class="nav-buttons">
            <div class="dropdown">
                <button>Menú</button>
                <div class="dropdown-content">
                    <!-- Enlace modificado para dirigir a la página "entradas.php" -->
                    <a href="entradas.php">Entradas</a>
                    <a href="#">Platos Fuertes</a>
                    <a href="bebidas.php">Bebidas</a>
                </div>
            </div>
            <button>Salir</button>
        </div>
    </div>
    
    <!-- Título de la sección -->
    <strong><div class="title">PLATOS FUERTES</div></strong>

    <!-- Contenedor principal para las tarjetas -->
    <div class="container">
        <!-- Tarjeta para la mesa 1 -->
        <div class="card">
            <h2>MESA</h2>
            <ul>
                <li>
                    Producto
                    <div class="specifications">Especificaciones del producto 1</div>
                    <?php
                    include("../controllers/BDcocina.php");
                    ?>
                </li>
            
            </ul>
            <div class="status">
                <button class="btn in-process">EN PROCESO</button>
                <button class="btn finished">FINALIZADO</button>
            </div>
        </div>
    </div>
</body>
</html>
