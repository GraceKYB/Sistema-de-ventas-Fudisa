<?php
require_once "config/db.php";
require_once "models/Perfil.php";
require_once "controllers/PerfilController.php";
require_once "models/usuario.php";
require_once "controllers/UsuarioController.php";

$a = isset($_GET['a']) ? $_GET['a'] : 'login';
$controlador = new UsuarioController();

if (method_exists($controlador, $a)) {
    $controlador->$a($conexion);
} else {
    echo "❌ El método <b>$a</b> no existe en PerfilController.";
}
