<?php
    require_once __DIR__."/../includes/app.php";

    use MVC\Router;
    use Controllers\LoginController;
    use Controllers\AdminController;
    use Controllers\ServicioController;
    use Controllers\ReservaController;
    use Controllers\ApiController;

    $router = new Router;

    //Crear cuenta
    $router->get("/", [LoginController::class, "crear"]);
    $router->post("/", [LoginController::class, "crear"]);

    //Confirmar cuenta
    $router->get("/mensaje", [LoginController::class, "mensaje"]);
    $router->get("/confirmar-cuenta", [LoginController::class, "confirmar"]);

    //Manejo de sesión
    $router->get("/login", [LoginController::class, "login"]);
    $router->post("/login", [LoginController::class, "login"]);
    $router->get("/logout", [LoginController::class, "logout"]);

    //Recuperar usuario
    $router->get("/olvidado", [LoginController::class, "olvidado"]);
    $router->post("/olvidado", [LoginController::class, "olvidado"]);
    $router->get("/recuperar", [LoginController::class, "recuperar"]);
    $router->post("/recuperar", [LoginController::class, "recuperar"]);
    
    // Área privada
    $router->get("/reserva", [ReservaController::class, 'index']);
    $router->get("/admin", [AdminController::class, 'index']);

    //CRUD servicios
    $router->get("/servicios", [ServicioController::class, "index"]);
    $router->get("/servicios/crear", [ServicioController::class, "crear"]);
    $router->post("/servicios/crear", [ServicioController::class, "crear"]);
    $router->get("/servicios/actualizar", [ServicioController::class, "actualizar"]);
    $router->post("/servicios/actualizar", [ServicioController::class, "actualizar"]);
    $router->post("/servicios/eliminar", [ServicioController::class, "eliminar"]);

    //Api de citas
    $router->get("/api/servicios", [ApiController::class, "index"]);
    $router->post("/api/reservas", [ApiController::class, "guardar"]);

    $router->comprobarRutas();
?>