<?php
session_start();

// Destruir todas las variables de sesión.
$_SESSION = array();

session_destroy();
HEADER("Location:index.php"); // regresa al inicio
?>
