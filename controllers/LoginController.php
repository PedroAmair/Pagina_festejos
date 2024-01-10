<?php
    namespace Controllers;

    use Classes\Email;
    use Model\Usuario;
    use MVC\Router;

    Class LoginController {
        public static function crear(Router $router) {
            $alertas = [];

            $usuario = new Usuario();

            if($_SERVER["REQUEST_METHOD"] === "POST") {
                $usuario->sincronizar($_POST);

                $alertas = $usuario->validarNuevaCuenta();

                if(empty($alertas)) {
                    $resultado = $usuario->existeUsuario();

                    if($resultado->num_rows) {
                        $alertas = $usuario::getAlertas();
                    }else{
                        $usuario->hashPassword();
                        $usuario->crearToken();

                        $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                        $email->enviarConfirmacion();

                        $resultado = $usuario->guardar();

                        if($resultado) {
                            header("location: /mensaje");
                        }
                    }
                }
            }

            $router->render("auth/crear-cuenta", [
                "alertas" => $alertas,
                "usuario" => $usuario
            ]);
        }

        public static function mensaje(Router $router) {
            $router->render('auth/mensaje');
        }

        public static function confirmar(Router $router) {
            $alertas = [];
            $token = esc($_GET['token']);
            $usuario = Usuario::where('token', $token);
    
            if(empty($usuario)) {
                Usuario::setAlerta('error', 'Token No Válido');
            } else {
                $usuario->confirmado = "1";
                $usuario->token = null;
                $usuario->guardar();
                Usuario::setAlerta('exito', 'Cuenta Comprobada Correctamente');
            }
           
            $alertas = Usuario::getAlertas();
    
            $router->render('auth/confirmar-cuenta', [
                'alertas' => $alertas
            ]);
        }

        public static function login(Router $router) {
            $alertas = [];

            if($_SERVER["REQUEST_METHOD"] === "POST") {
                $auth = new Usuario($_POST);

                $alertas = $auth->validarLogin();

                if(empty($alertas)) {
                    $usuario = Usuario::where("email", $auth->email);

                    if($usuario) {
                        if($usuario->comprobarPasswordAndVerificado($auth->password)) {
                            session_start();

                            $_SESSION["id"] = $usuario->id;
                            $_SESSION["nombre"] = $usuario->nombre ." ". $usuario->apellido;
                            $_SESSION["email"] = $usuario->email;
                            $_SESSION["login"] = true;

                            if($usuario->admin === "1") {
                                $_SESSION["admin"] = $usuario->admin;
                                header("location: /admin");
                            }else{
                                header("location: /reserva");
                            }
                        }
                    }else{
                        Usuario::setAlerta("error", "usuario no encontrado");
                    }
                }
            }

            $alertas = Usuario::getAlertas();

            $router->render("auth/login", [
                "alertas" => $alertas
            ]);
        }

        public static function logout() {
            session_start();
            $_SESSION = [];
            header("Location: /");
        }

        public static function olvidado(Router $router) {
            $alertas = [];

            if($_SERVER["REQUEST_METHOD"] === "POST") {
                $auth = new Usuario($_POST);
                $alertas = $auth->validarEmail();

                if(empty($alertas)) {
                    $usuario = Usuario::where("email", $auth->email);

                    if($usuario && $usuario->confirmado === "1") {
                        $usuario->crearToken();
                        $usuario->guardar();

                        $email = new email($usuario->email, $usuario->nombre, $usuario->token);
                        $email->enviarInstrucciones();

                        Usuario::setAlerta("exito", "revisa tu correo para continuar el proceso");
                    }else{
                        Usuario::setAlerta("error", "Usuario no existe o está sin confirmar");
                    }
                }
            }
            
            $alertas = Usuario::getAlertas();

            $router->render("auth/olvidado", [
                "alertas" => $alertas
            ]);
        }

        public static function recuperar(Router $router) {
            $alertas = [];
            $error = false;

            $token = $_GET["token"];

            $usuario = Usuario::where("token", $token);

            if(empty($usuario)) {
                Usuario::setAlerta("error", "Token inválido");
                $error = true;
            }

            if($_SERVER["REQUEST_METHOD"] === "POST") {
                $password = new Usuario($_POST);

                $alertas = $password->validarPassword();

                if(empty($alertas)) {
                    $usuario->password = null;
                    $usuario->password = $password->password;
                    $usuario->hashPassword();
                    $usuario->token = null;

                    $resultado = $usuario->guardar();

                    if($resultado) {
                        header("location: /login");
                    }
                }
            }

            $alertas = Usuario::getAlertas();

            $router->render("auth/recuperar", [
                "alertas" => $alertas,
                "error" => $error
            ]);
        }
    }

?>