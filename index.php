<!DOCTYPE html>
<!-- Coding By CodingNepal - www.codingnepalweb.com -->
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RePOS</title>
  <link rel="stylesheet" href="styles/index.css">
  <link rel="stylesheet" href="styles/fontStyles.css">
</head>
<body>
  <div class="wrapper">
    <?php
        include("controllers/conexion.php");
        include("controllers/loginC.php");
    ?>
    <form method="POST">
      <h2>Bienvenido</h2>
        <div class="input-field">
        <input type="text" required name="user">
        <label>Usuario</label>
      </div>
      <div class="input-field">
        <input type="password" name="pass"required>
        <label>Contraseña</label>
      </div>
      <div class="forget">
        <a href="#">Forgot password?</a>
      </div>
      <div class="buttons">
        <a href="views/kitchen.php">
          <button type="button">Invitado</button>
        </a>
        <button type="submit">Iniciar Sesión</button>
      </div>
    </form>
  </div>
</body>
</html>