<?php
include_once('../conexion/db.php');
session_start();
$id = $_SESSION['id'];

$query = pg_query($conexion, "select foto FROM usuarios WHERE id =4");
$row   = pg_fetch_row($query);
$image = pg_unescape_bytea($row[0]);

header("Content-type: image/jpeg");
echo $image;

pg_close($conn);