<?php
session_start();

//Limpia todas las variables de sesión
$_SESSION = array();

//Si se desea destruir la sesión completamente, también se debe eliminar la cookie de sesión
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();
//redirección
header("Location: ../index.php");
exit;
?>
