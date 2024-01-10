<?php
    namespace Controllers;

    use MVC\Router;
    use Model\Reserva;

    class ReservaController {
        public static function index(Router $router) {
            isAuth();
            
            $router->render("reserva/index", [
                "nombre" => $_SESSION["nombre"],
                "id" => $_SESSION["id"]
            ]);
        }
    }
?>