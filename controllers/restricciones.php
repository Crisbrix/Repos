<?php
// admin_home.php
session_start();
if (!array_key_exists('user_id', $_SESSION)) {
   header('Location: login.html');
   die;
}
$allowedRoles = ['admin'];
if (!array_key_exists('role', $_SESSION) || !in_array($_SESSION['role'], $allowdRoles)) {
   header('Location: login.html');
   die;
}
?>
<h1>Bienvenido </h1>