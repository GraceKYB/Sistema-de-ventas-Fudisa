<?php

require_once  "models/perfil.php";

class PerfilController{


    public function listar($conexion){
        $perfil=new Perfil($conexion);
        $perfiles=$perfil->listarPerfil();
        include "views/perfiles/listar.php";
    }

    public function crear($conexion) {
        $perfil = new Perfil($conexion);
        $error = "";
        $mensaje = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $permisos = $_POST['permisos'];
            $estado = isset($_POST['estado']) ? 1 : 0;

            if ($perfil->crearPerfil($nombre, $permisos, $estado)) {
                $mensaje = "✅ Perfil creado correctamente";
            } else {
                $error = "❌ El nombre ya existe o hubo un error al guardar";
            }
        }

        include "views/perfiles/crear.php";
    }

    public function editar($conexion) {
        $perfil = new Perfil($conexion);

        if (!isset($_GET['id'])) {
            echo "❌ ID no proporcionado.";
            exit;
        }

        $id = $_GET['id'];
        $perfilData = $perfil->obtenerPorId($id);

        if (!$perfilData) {
            echo "❌ Perfil no encontrado.";
            exit;
        }

        // Si se envía el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $permisos = $_POST['permisos'];
            $estado = isset($_POST['estado']) ? 1 : 0;

            if ($perfil->editarPerfil($id, $nombre, $permisos, $estado)) {
                header("Location: index.php?a=listar");
                exit;
            } else {
                $error = "❌ Error al actualizar el perfil.";
            }
        }

        include "views/perfiles/editar.php";
    }
    

    
}
