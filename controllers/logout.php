<?php
session_start();
session_destroy();

header("localitation:./index.php");
exit;
?>