<?php

class usuario {

    private $conexion;

    public function __construct($conexion){
        $this->conexion=$conexion;
    }
    
    public function registrarUsuario($username, $password, $nombre_completo, $email, $id_perfil, $estado) {
        if ($this->existeUsuario($username, $email)) {
            return false; // Ya existe usuario o email
        }

        // Encriptar contraseña
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO usuario (username, password, nombre_completo, email, id_perfil, estado)
                VALUES (:username, :password, :nombre_completo, :email, :id_perfil, :estado)";
        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $passwordHash);
        $stmt->bindParam(":nombre_completo", $nombre_completo);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":id_perfil", $id_perfil);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_BOOL);

        return $stmt->execute();
    }

    public function listarPerfilesActivos() {
        $sql = "SELECT id_perfil, nombre FROM perfil WHERE estado = 1";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function existeUsuario($username, $email) {
        $sql = "SELECT COUNT(*) FROM usuario WHERE username = :username OR email = :email";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function login($username, $password) {
        $sql = "SELECT u.*, p.nombre AS perfil_nombre 
                FROM usuario u 
                LEFT JOIN perfil p ON u.id_perfil = p.id_perfil
                WHERE u.username = :username AND u.estado = 1";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($password, $usuario['password'])) {
            return $usuario;
        }
        return false;
    }


}