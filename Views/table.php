<?php
  include("../controllers/conexion.php");
  include("../controllers/tableC.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RePOS</title>
  <link rel="stylesheet" href="../styles/table.css">
  <link rel="stylesheet" href="../styles/fontStyles.css">
</head>
<body>
  <div class="wrapper">
    <form method="POST">
      <h2>Bienvenido</h2>
      <div class="input-field">
        <input type="text" required name="table">
        <label>Ingrese la mesa que desea</label>
      </div>
      <button type="submit">Enviar</button>
    </form>
  </div>
</body>
</html>