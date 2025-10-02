<?php

require_once "models/usuario.php";

class UsuarioController{
    
    public function registrar($conexion){
        $usuario =new Usuario($conexion);
        $perfiles = $usuario->listarPerfilesActivos();

        $mensaje=$error="";

        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $username=$_POST["username"];
            $password=$_POST["password"];
            $nombre_completo=$_POST["nombre_completo"];
            $email=$_POST["email"];
            $id_perfil=$_POST["id_perfil"];
            $estado = isset($_POST["estado"]) ? 1 : 0;

            if($usuario->registrarUsuario($username,$password,$nombre_completo,$email,$id_perfil,$estado)){
                $mensaje="Usuario creado exitosamente";
            
            }else{
                $error="El nombre o correo ya existe";
            }           
        }

    include "views/usuario/registrar.php";

    }

     public function login($conexion) {
        session_start();
        $error = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $usuarioModel = new Usuario($conexion);
            $usuario = $usuarioModel->login($username, $password);

            if ($usuario) {
                $_SESSION['usuario'] = $usuario;
                header("Location: views/dashboard.php");
                exit;
            } else {
                $error = "❌ Usuario o contraseña incorrectos.";
            }
        }

        require "views/usuario/login.php";
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php");
        exit;
    }
}