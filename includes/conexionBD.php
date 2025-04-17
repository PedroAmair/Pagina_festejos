<?php

$host = getenv("MYSQLHOST");
$user = getenv("MYSQLUSER");
$password = getenv("MYSQLPASSWORD");
$database = getenv("MYSQLDATABASE");
$port = (int) getenv("MYSQLPORT");

if (!$host || !$user || !$password || !$database || !$port) {
    die("Error: Algunas variables de entorno no están definidas correctamente.");
}

$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

/*$_ENV["MYSQLHOST"],
$_ENV["MYSQLUSER"],
$_ENV["MYSQLPASSWORD"] ?? "",
$_ENV["MYSQLDATABASE"],
$_ENV["MYSQLPORT"]*/

?>