<?php
include("../controllers/returncontrolc.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devoluciones</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/returncontrol.css">
    <link rel="stylesheet" href="../styles/fontStyles.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Lilita+One&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <ul>
            <li><a class="link" href="home.php">RePos</a></li>
            <li><a class="link" href="table.php?action=add">Adición Pedido</a></li>
            <li><a class="link" href="table.php?action=view">Ver Pedido</a></li>
            <li class="dropdown">
            <a href="" class="dropbtn"><?php echo $name?></a>
                <div class="dropdown-content">
                    <a href="../controllers/logout.php">Cerrar Sesión</a>
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
            <div class="devoluciones">
               <h1>Devoluciones</h1>
               
                <table border="1">
                <tr>
                        <th>Fecha</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Razón</th>
                        
                    </tr>
                <tr>
    <?php
     if ($result && $result->num_rows > 0) {
        // Salida de cada fila
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["fecha"] . "</td>";
            echo "<td>" . $row["producto"] . "</td>";
            echo "<td>" . $row["cantidad"] . "</td>";
            echo "<td>" . $row["precio"] . "</td>";
            echo "<td>" . $row["razon"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No hay devoluciones disponibles</td></tr>";
    }
    ?>
</tr>
                </table>
            </div>
        </div>
        </div>
</body>
</html>