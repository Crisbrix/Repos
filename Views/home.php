<?php
    include("../controllers/homeC.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mesas</title>
  <link rel="stylesheet" href="../styles/home.css">
  <link rel="stylesheet" href="../styles/fontStyles.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Lilita+One&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Menú de Navegación -->
    <nav>
        <ul>
            <li><a><?php
            // Consulta SQL para verificar las credenciales del usuario
            $sql = "SELECT nombre, rol FROM usuarios WHERE usuario_id = '$userId'";
            $result = $conn->query($sql);

            $row = $result->fetch_assoc();
            $name = ucfirst($row["nombre"]);
            $rol = ucfirst($row["rol"]);
            if ($result->num_rows > 0) {
                echo $rol;
            }
            
        ?></a>
        <li><a class="link" href="table.php?action=add">Adición Pedido</a></li>
        <li><a class="link" href="table.php?action=edit">Modificar Pedido</a></li>
        <li><a class="link" href="table.php?action=close">Cerrar Cuenta</a></li>
        <li><a class="link" href="table.php?action=view">Ver Pedido</a></li>
        <li><a class="link" href="../controllers/logout.php">Cerrar Sesión</a></li>
            <?php 
                echo $name;
            ?>
        </ul>
    </nav>
    <h2 class="tittle">Mesas del Restaurante</h2>
    <div class="containerTable">
        <!-- Sección Alcón Derecho -->
        <div class="section">
            <h3>Alcón Derecho</h3>
            <div class="tables">
            <?php
                for ($i = 1; $i <= 18; $i++) {
                $class = in_array($i, $mesas_ocupadas) ? 'table alcon-derecho ocupada' : 'table alcon-derecho';
                echo "<div class='$class'>$i</div>";
                }
            ?>
            </div>
        </div>

        <!-- Sección Alcón Izquierdo -->
        <div class="section">
            <h3>Alcón Izquierdo</h3>
            <div class="tables">
            <?php
                for ($i = 21; $i <= 47; $i++) {
                $class = in_array($i, $mesas_ocupadas) ? 'table alcon-izquierdo ocupada' : 'table alcon-izquierdo';
                echo "<div class='$class'>$i</div>";
                }
            ?>
            </div>
        </div>

        <!-- Sección Palco -->
        <div class="section">
            <h3>Palco</h3>
            <div class="tables">
            <?php
                for ($i = 51; $i <= 70; $i++) {
                $class = in_array($i, $mesas_ocupadas) ? 'table palco ocupada' : 'table palco';
                echo "<div class='$class'>$i</div>";
                }
            ?>
            </div>
        </div>
    </div>
</body>
</html>

