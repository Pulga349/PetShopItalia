<?php
define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("DB", "crudstock");

$conn = new mysqli(HOST, USER, PASS, DB);

if ($conn->connect_error) {
    die("Fallo la conexion con la base de datos: " . $conn->connect_error);
}else{
    mysqli_set_charset($conn, "utf8");
}
?>