<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function esc($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function esUltimo(string $actual, string $proximo): bool {

    if($actual !== $proximo) {
        return true;
    }
    return false;
}

// Función que revisa que el usuario este autenticado
function isAuth() : void {
    session_start();
    
    if(!isset($_SESSION["login"])) {
        header('Location: /');
    }
}

function isAdmin() : void {
    session_start();
    
    if(!isset($_SESSION["admin"])) {
        header('Location: /');
    }
}