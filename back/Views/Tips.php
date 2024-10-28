<!DOCTYPE html>
<html lang="es"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RePOS - Propinas</title>
    <link rel="stylesheet" href="../styles/Tips.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Dancing+Script&display=swap" rel="stylesheet"/>
</head>
<body>
    <div class="header">
        <div class="title">RePOS</div>
        <div class="nav">
            <a href="#">Atras</a>
            <a href="../views/home.php" class="salir-button">Salir</a>
        </div>
    </div>
    <div class="logo">
        <img alt="Logo of La Kamelia Restaurant with a horse image" src="../IMG/logo.png"/>
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
