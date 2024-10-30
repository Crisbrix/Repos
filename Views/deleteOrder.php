<?php include("../controllers/deleteOrderC.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminarpedido</title>
    <link rel="stylesheet" href="../styles/deleteOrder.css">
    <link rel="stylesheet" href="../styles/fontStyles.css">
    <link rel="stylesheet" href="../styles/styles.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Lilita+One&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <ul>        
            <li><p class="tittle">REPOS</p></li>
            <li class="dropdown">
                <a href="starters.php" class="dropbtn">Menú</a>
                <div class="dropdown-content">
                    <a href="home.php">Salir</a>
                </div>
            </li>
        </ul>
    </nav>
            <div class="container">
                <div class="cuadro">
                    <div class="sup">
                        <div class="imagen"><img src="../img/logo.jpg" alt="NO SE ENCONTRO"></div>
                        <div class="textos">
                            <h1>La Kamelia</h1>
                            <h2>Restaurante</h2>
                            <hr style="border: none; border-top: 2px solid #000;">
                        </div><!-- Fin textos -->
                    </div><!-- Fin sup -->
                   <div class="productos">
                    <?php 
if (!empty($pedidos)) {

    foreach ($pedidos as $pedido) {
        echo '<div class="pedido-item">';
        echo "<li>" . htmlspecialchars($pedido['producto']) . "............. " . htmlspecialchars($pedido['cantidad']) . "</li>";
        // Asegúrate de tener el detalle_id en tus resultados
        echo '<form method="post" action="../controllers/deleteOrderC.php">';
        echo '<input type="hidden" name="detalle_id" value="' . htmlspecialchars($pedido['detalle_id']) . '">'; // Campo oculto para detalle_id
        echo '<input type="text" name="comentario" placeholder="Escribe un comentario" required>';
        echo '<button type="submit">Eliminar</button>';
        echo '</form>';
        echo '</div>';
    }
} else {
    echo "<li>No hay productos disponibles.</li>";
}
?>
  </div>              
                </div><!-- Fin cuadro -->
</body>

</html>