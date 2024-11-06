<?php
include("../controllers/homeC.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RePOS - PERSONAL</title>
    <link rel="stylesheet" href="../styles/Staff.css">
  <link rel="stylesheet" href="../styles/styles.css">
  <link rel="stylesheet" href="../styles/fontStyles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Dancing+Script&display=swap" rel="stylesheet"/>
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
                                    <a href="inventary.php">Inventarios</a>
                                    <a href="staff.php">Personal</a>
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
    <div class="logo">
        <img alt="Logo of La Kamelia Restaurant with a horse image" src="../IMG/logo.png"/>
        <div class="restaurant-name">La Kamelia</div>
        <div class="restaurant-subtitle">Restaurante</div>
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th colspan="2">PERSONAL</th>
                </tr>
                <tr>
                    <th>MESERO</th>
                    <th>VALOR</th>
                </tr>
            </thead>
            <tbody class="scrollable" id="sueldos-body">
                <?php include("../controllers/StaffC.php"); ?>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td>TOTAL</td>
                    <td><?php echo $total_sueldo; ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <form id="finalizar-form">
        <button type="button" id="finalizar" class="btn finalizar">Finalizar</button>
    </form>

    <script>
        document.getElementById('finalizar').addEventListener('click', function() {
            // Eliminar el contenido de la tabla
            document.getElementById('sueldos-body').innerHTML = '';
            // Eliminar el total
            document.querySelector('.total-row td:last-child').textContent = '0,00';
        });
    </script>
</body>
</html>
