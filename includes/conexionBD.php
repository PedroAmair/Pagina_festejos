<?php
    $conn = new mysqli(
        /*$_ENV["MYSQLHOST"],
        $_ENV["MYSQLUSER"],
        $_ENV["MYSQLPASSWORD"] ?? "",
        $_ENV["MYSQLDATABASE"],
        $_ENV["MYSQLPORT"]*/

        getenv("MYSQLHOST"),
        getenv("MYSQLUSER"),
        getenv("MYSQLPASSWORD"),
        getenv("MYSQLDATABASE"),
        (int) getenv("MYSQLPORT")
    );

    $conn->set_charset('utf8');

    if($conn->connect_error) {
        echo $error->$conn->connect_error;
    }

?>