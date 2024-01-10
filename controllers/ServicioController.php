<?php
    namespace Controllers;

    use MVC\Router;
    use Model\Servicio;

    Class ServicioController {
        public static function index(Router $router) {
            isAdmin();

            $servicios = Servicio::all();
            
            $router->render("servicios/index", [
                "nombre" => $_SESSION["nombre"],
                "servicios" => $servicios
            ]);
        }

        public static function crear(Router $router) {
            isAdmin();

            $alertas = [];
            $servicio = new Servicio;

            if($_SERVER["REQUEST_METHOD"] === "POST") {
                $servicio->sincronizar($_POST);
                $alertas = $servicio->validar();

                if(empty($alertas)) {
                    $servicio->guardar();
                    header("location: /servicios");
                }
            }

            $router->render("servicios/crear", [
                "nombre" => $_SESSION["nombre"],
                "alertas" => $alertas,
                "servicio" => $servicio
            ]);
        }

        public static function actualizar(Router $router) {
            isAdmin();
            
            if(!is_numeric($_GET["id"])) return;
            $servicio = Servicio::find($_GET["id"]);
            $alertas = [];

            if($_SERVER["REQUEST_METHOD"] === "POST") {
                $servicio->sincronizar($_POST);
                $alertas = $servicio->validar();
    
                if(empty($alertas)) {
                    $servicio->guardar();
                    header("location: /servicios");
                }
    
            }

            $router->render("servicios/actualizar", [
                "alertas" => $alertas,
                "nombre" => $_SESSION["nombre"],
                "servicio" => $servicio
            ]);
        }

        public static function eliminar(Router $router) {
            isAdmin();

            if($_SERVER["REQUEST_METHOD"] === "POST") {
                $id = $_POST["id"];
                $servicio = Servicio::find($id);
                $servicio->eliminar();

                header("location: /servicios");
            }
            
        }
    }

?>
