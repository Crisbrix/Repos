<!DOCTYPE html>
<html lang="es"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RePOS - Propinas</title>
    <link rel="stylesheet" href="../styles/Tips.css">
    <link rel="stylesheet" href="../styles/fontStyles.css">
    <link rel="stylesheet" href="../styles/styles.css">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Dancing+Script&display=swap" rel="stylesheet"/>
</head>
<body>
    <nav>
        <ul>
            <li>
                <a>
                    <?php
                        session_start();

                        include("../controllers/conexion.php");
                    
                        if (isset($_SESSION['userid'])) {
                            $userId = $_SESSION['userid'];  
                        } else {
                            header("Location: ../index.php");
                        } 
                        // Consulta SQL para verificar las credenciales del usuario
                        $sql = "SELECT nombre, rol FROM usuarios WHERE usuario_id = '$userId'";
                        $result = $conn->query($sql);

                        $row = $result->fetch_assoc();
                        $name = ucfirst($row["nombre"]);
                        $rol = ucfirst($row["rol"]);
                        
                        echo $rol; // Muestra el nombre del mesero
                    ?>
                </a>
            </li>
            <li><a class="link" href="home.php">Salir</a></li>
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
        <img alt="Logo of La Kamelia Restaurant with a horse image" src="../img/logo.jpg"/>
        <div class="restaurant-name">La Kamelia</div>
        <div class="restaurant-subtitle">Restaurante</div>
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th colspan="2">PROPINA</th>
                </tr>
                <tr>
                    <th>MESERO</th>
                    <th>VALOR</th>
                </tr>
            </thead>
            <tbody class="scrollable">
                <?php include("../controllers/TipsC.php"); ?>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td>TOTAL</td>
                    <td><?php echo $totalPropinas; ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <button type="submit" name="finalizar" class="btn finalizar">Finalizar</button>
    </form>
</body>
</html>
