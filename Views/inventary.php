<?php
    include("../controllers/inventaryC.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventario</title>
  <link rel="stylesheet" href="../styles/home.css">
  <link rel="stylesheet" href="../styles/styles.css">
  <link rel="stylesheet" href="../styles/fontStyles.css">
  <link rel="stylesheet" href="../styles/inventary.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Lilita+One&display=swap" rel="stylesheet">

</head>
<body>
    <nav>
        <ul>
            <li>
                <a><?php
                    // Consulta SQL para verificar las credenciales del usuario
                    $sql = "SELECT nombre, rol FROM usuarios WHERE usuario_id = '$userId'";
                    $result = $conn->query($sql);

                    $row = $result->fetch_assoc();
                    $name = ucfirst($row["nombre"]);
                    $rol = ucfirst($row["rol"]);
                    if ($result->num_rows > 0) {
                        echo $rol; // Mostrar el rol del usuario (ej: Mesero)
                    }
                ?></a>
            </li>
            <li><a class="link" href="table.php?action=add">Adición Pedido</a></li>
            <li><a class="link" href="table.php?action=view">Ver Pedido</a></li>
            <?php
                if ($rol == 'Admin'){
                    echo '<li><a class="link" href="table.php?action=edit">Modificar Pedido</a></li>';
                    echo '<li class="dropdown dropbtn">Reportes
                                <div class="dropdown-content">
                                    <a href="../controllers/logout.php">Inventarios</a>
                                    <a href="../controllers/logout.php">Personal</a>
                                    <a href="Tips.php">Popinas</a>
                                </div>
                         </li>';
                }

                if ($rol == 'Admin' || $rol == 'Caja'){
                    echo '<li><a class="link" href="table.php?action=close">Cerrar Cuenta</a></li>';
                }
            ?>
            <li class="dropdown">
            <a href="" class="dropbtn"><?php 
                echo $name; // Muestra el nombre del mesero
            ?></a>
                <div class="dropdown-content">
                    <a href="../controllers/logout.php">Cerrar Sesión</a>
                </div>
            </li>
        </ul>
    </nav>
    <h2 class="tittle">Inventario</h2>
    <div class="containerTable">
        <table class="inventory-table">
            <thead>
                <tr>
                    <th>ID Inventario</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Fecha de Actualización</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Consulta de inventario
                $sql = "SELECT i.inventario_id, p.nombre AS producto, i.cantidad, i.fecha_actualizacion
                FROM Inventario i
                JOIN Productos p ON i.producto_id = p.producto_id";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['inventario_id']}</td>
                                <td>{$row['producto']}</td>
                                <td>{$row['cantidad']}</td>
                                <td>{$row['fecha_actualizacion']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No hay datos en el inventario.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
