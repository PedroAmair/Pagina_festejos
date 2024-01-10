<?php
    $conn = new mysqli(
        $_ENV["MYSQLHOST"],
        $_ENV["MYSQLUSER"],
        $_ENV["MYSQLPASSWORD"] ?? "",
        $_ENV["MYSQLDATABASE"],
        //$_ENV["MYSQLPORT"]
    );

    $conn->set_charset('utf8');

    if($conn->connect_error) {
        echo $error->$conn->connect_error;
    }

?>