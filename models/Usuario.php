<?php
    namespace Model;

    Class Usuario extends ActiveRecord {
        protected static $tabla = "usuarios";
        protected static $columnasDB = ["id", "nombre", "apellido", "email", "telefono", "password", "token", "confirmado", "admin"];

        public $id;
        public $nombre;
        public $apellido;
        public $email;
        public $telefono;
        public $password;
        public $token;
        public $confirmado;
        public $admin;

        public function __construct($args=[])
        {
            $this->id = $args["id"] ?? null;
            $this->nombre = $args["nombre"] ?? "";
            $this->apellido = $args["apellido"] ?? "";
            $this->email = $args["email"] ?? "";
            $this->telefono = $args["telefono"] ?? "";
            $this->password = $args["password"] ?? "";
            $this->token = $args["token"] ?? "";
            $this->confirmado = $args["confirmado"] ?? 0;
            $this->admin = $args["admin"] ?? 0;
        }

        public function validarNuevaCuenta() {
            if(!$this->nombre) {
                self::$alertas["error"][] = "Debe ingresar el nombre";
            }
            if(!$this->apellido) {
                self::$alertas["error"][] = "Debe ingresar el apellido";
            }
            if(!$this->telefono) {
                self::$alertas["error"][] = "Debe ingresar un número de teléfono";
            }
            if(!$this->email) {
                self::$alertas["error"][] = "Debe colocar el correo electrónico";
            }
            if(!$this->password) {
                self::$alertas["error"][] = "El password es necesario";
            }
            if($this->password && strlen($this->password) < 6) {
                self::$alertas["error"][] = "Su password debe contener al menos 6 caracteres";
            }

            return self::$alertas;
        }

        public function existeUsuario() {
            $query = " SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
    
            $resultado = self::$db->query($query);
    
            if($resultado->num_rows) {
                self::$alertas['error'][] = 'El Usuario ya esta registrado';
            }
    
            return $resultado;
        }

        public function hashPassword() {
            $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        }

        public function crearToken() {
            $this->token = uniqid();
        }

        public function validarLogin() {
            if(!$this->email) {
                self::$alertas['error'][] = 'El email es Obligatorio';
            }
            if(!$this->password) {
                self::$alertas['error'][] = 'El Password es Obligatorio';
            }
    
            return self::$alertas;
        }

        public function comprobarPasswordAndVerificado($password) {
            $resultado = password_verify($password, $this->password);
            
            if(!$resultado || !$this->confirmado) {
                self::$alertas['error'][] = 'Password Incorrecto o cuenta no confirmada';
            } else {
                return true;
            }
        }

        public function validarEmail() {
            if(!$this->email) {
                self::$alertas['error'][] = 'El email es Obligatorio';
            }
            return self::$alertas;
        }

        public function validarPassword() {
            if(!$this->password) {
                self::$alertas['error'][] = 'El Password es obligatorio';
            }
            if($this->password && strlen($this->password) < 6) {
                self::$alertas['error'][] = 'El Password debe tener al menos 6 caracteres';
            }
    
            return self::$alertas;
        }

    }

?>