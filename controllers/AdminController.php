<?php

    namespace Controllers;

    use MVC\Router;
    use Model\AdminReserva;

    class AdminController {
        public static function index(Router $router) {
            isAdmin();

            $fecha = $_GET["fecha"] ?? date("Y-m-d");
            $fechas = explode("-", $fecha);

            if(!checkdate($fechas[1], $fechas[2], $fechas[0])) {
                header("location: /404");
            }

            $consulta = "SELECT reservas.id, reservas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
            $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
            $consulta .= " FROM reservas  ";
            $consulta .= " LEFT OUTER JOIN usuarios ";
            $consulta .= " ON reservas.usuarioid=usuarios.id  ";
            $consulta .= " LEFT OUTER JOIN reservasservicios ";
            $consulta .= " ON reservasservicios.reservaid=reservas.id ";
            $consulta .= " LEFT OUTER JOIN servicios ";
            $consulta .= " ON servicios.id=reservasservicios.servicioid ";
            $consulta .= " WHERE fecha =  '{$fecha}' ";

            $reservas = AdminReserva::SQL($consulta);
            
            $router->render("admin/index", [
                "nombre" => $_SESSION["nombre"],
                "reservas" => $reservas,
                "fecha" => $fecha
            ]);
        }
    }

?>