<?php

class perfil{
    private $conexion;

    public function __construct($conexion) {
        $this->conexion=$conexion;
    }

    public function listarPerfil(){
        $sql="SELECT * FROM perfil";
        $stmt=$this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    // Validar que el nombre no esté duplicado
    public function existeNombre($nombre) {
        $sql = "SELECT COUNT(*) FROM perfil WHERE nombre = :nombre";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn() > 0; 
    }

    public function crearPerfil($nombre,$permisos,$estado){
         
        if ($this->existeNombre($nombre)) {
            return false; 
        }

        $sql="INSERT INTO perfil (nombre,permisos,estado) VALUES (:nombre,:permisos,:estado)";
        $stmt=$this->conexion->prepare($sql);
        $stmt->bindParam(":nombre",$nombre,PDO::PARAM_STR);
        $stmt->bindParam(":permisos",$permisos,PDO::PARAM_STR);
        $stmt->bindParam(":estado",$estado,PDO::PARAM_BOOL);

        return $stmt->execute();
    }
    
    public function editarPerfil($id,$nombre,$permisos,$estado){
        $sql="UPDATE perfil SET nombre=:nombre, permisos=:permisos, estado=:estado WHERE id_perfil=:id";
        $stmt=$this->conexion->prepare($sql);

        $stmt->bindParam("id", $id,PDO::PARAM_INT);
        $stmt->bindParam(":nombre",$nombre);
        $stmt->bindParam(":permisos",$permisos);
        $stmt->bindParam(":estado",$estado);

        return $stmt->execute();

    }
    
    public function obtenerPorId($id){
        $sql="SELECT * FROM perfil WHERE id_perfil=:id";
        $stmt=$this->conexion->prepare($sql);

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cambiarEstado($id, $estado) {
        $sql = "UPDATE perfil SET estado = :estado WHERE id_perfil = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_BOOL);
        return $stmt->execute();
    }

}