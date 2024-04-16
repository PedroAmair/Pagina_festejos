<?php
    namespace Controllers;

    use Model\Reserva;
    use MVC\Router;
    use Model\Servicio;
    use Model\ReservaServicio;

    class ApiController {
        public static function index(Router $router) {
            $servicios = Servicio::all();
            echo json_encode($servicios);
        }

        public static function guardar(Router $router) {
            $reserva = new Reserva($_POST);
            $resultado = $reserva->guardar();

            $id = $resultado["id"];

            $idServicios = explode(",", $_POST["servicios"]);
            foreach($idServicios as $idServicio) {
                $args = [
                    "reservaid" => $id,
                    "servicioid" => $idServicio
                ];

                $reservaServicio = new ReservaServicio($args);
                $reservaServicio->guardar();
            }

            echo json_encode(["resultado" => $resultado]);
        }
    }
?>