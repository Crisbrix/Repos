<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fuzzy+Bubbles:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>RePOS</title>
</head>
<body>
    <div class="container">
        <div class="cLeft">
            <img src="img/fondo1.jpg" alt="Descripción de la imagen">
            <p>soporte tecnico | <a href="./controllers/cerrar_sesion.php"> salir</a> </p>
            <h1>RePOS</h1>
        </div>

        <div class="cRigth">
            <div class="log">
                <form method="POST">
                    <br>
                    <p class="name">Usuario: </p><input class="in" type="text" name="email" placeholder="">
                    <p class="name">Contraseña: </p><input class="in" type="password" name="pass" placeholder="">
                    <input class="button login__submit" type="submit" name="btnLogin" value="Ianiciar Sesión">	
                    <br>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
