-- =====================================================
-- SCRIPT SQL COMPLETO - BD: fudisa (con tabla perfil y proveedor)
-- =====================================================

DROP DATABASE IF EXISTS fudisa;
CREATE DATABASE fudisa CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE fudisa;

-- =====================================================
-- TABLA: perfil
-- =====================================================
CREATE TABLE perfil (
  id_perfil INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  permisos TEXT,
  estado BOOLEAN DEFAULT 1, -- 1=activo, 0=inactivo
  fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- =====================================================
-- TABLA: categoria_producto
-- =====================================================
CREATE TABLE categoria_producto (
  id_cateProd INT AUTO_INCREMENT PRIMARY KEY,
  nom_categoria VARCHAR(250) NOT NULL,
  descripcion TEXT,
  estado BOOLEAN DEFAULT 1, -- 1=activo, 0=inactivo
  fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- =====================================================
-- TABLA: cliente
-- =====================================================
CREATE TABLE cliente (
  id_cliente INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(150) NOT NULL,
  apellido VARCHAR(150) NOT NULL,
  cedula VARCHAR(20) UNIQUE,
  telefono VARCHAR(20),
  email VARCHAR(150) UNIQUE,
  direccion VARCHAR(250),
  tipo_cliente VARCHAR(50) DEFAULT 'general',
  estado BOOLEAN DEFAULT 1, -- 1=activo, 0=inactivo
  fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- =====================================================
-- TABLA: usuario
-- =====================================================
CREATE TABLE usuario (
  id_usuario INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL, -- almacenar hash seguro (bcrypt, argon2, etc.)
  nombre_completo VARCHAR(250),
  email VARCHAR(150) UNIQUE,
  id_perfil INT,
  estado BOOLEAN DEFAULT 1, -- 1=activo, 0=inactivo
  ultimo_login DATETIME NULL,
  FOREIGN KEY (id_perfil) REFERENCES perfil(id_perfil)
    ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB;

-- =====================================================
-- TABLA: proveedor
-- =====================================================
CREATE TABLE proveedor (
  id_proveedor INT AUTO_INCREMENT PRIMARY KEY,
  codigo VARCHAR(50) UNIQUE NOT NULL,
  nombre VARCHAR(200) NOT NULL,
  telefono VARCHAR(20),
  email VARCHAR(150),
  direccion VARCHAR(250),
  porcentaje_pago DECIMAL(5,2) DEFAULT 0.00,
  estado BOOLEAN DEFAULT 1, -- 1=activo, 0=inactivo
  fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- =====================================================
-- TABLA: producto
-- =====================================================
CREATE TABLE producto (
  id_producto INT AUTO_INCREMENT PRIMARY KEY,
  codigo_prod VARCHAR(100) UNIQUE NOT NULL,
  nombre_prod VARCHAR(250) NOT NULL,
  descripcion TEXT,
  precio DECIMAL(10,2) NOT NULL,
  costo DECIMAL(10,2) DEFAULT 0,
  imagen_url VARCHAR(500),
  comentario VARCHAR(50),
  estado_local VARCHAR(50),
  estado BOOLEAN DEFAULT 1, -- 1=activo, 0=inactivo
  id_categoria INT,
  id_proveedor INT,
  FOREIGN KEY (id_categoria) REFERENCES categoria_producto(id_cateProd)
    ON UPDATE CASCADE ON DELETE SET NULL,
  FOREIGN KEY (id_proveedor) REFERENCES proveedor(id_proveedor)
    ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB;

-- =====================================================
-- TABLA: inventario
-- =====================================================
CREATE TABLE inventario (
  id_inventario INT AUTO_INCREMENT PRIMARY KEY,
  id_producto INT NOT NULL,
  stock INT NOT NULL DEFAULT 0,
  stock_minimo INT DEFAULT 0,
  stock_maximo INT DEFAULT NULL,
  ubicacion VARCHAR(150),
  ultima_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (id_producto) REFERENCES producto(id_producto)
    ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

-- =====================================================
-- TABLA: ventas
-- =====================================================
CREATE TABLE ventas (
  id_venta INT AUTO_INCREMENT PRIMARY KEY,
  codigo_venta VARCHAR(50),
  fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
  id_usuario INT NOT NULL,
  id_cliente INT,
  metodo_pago VARCHAR(50) DEFAULT 'efectivo',
  comentario VARCHAR(50),
  descuento_total DECIMAL(10,2) DEFAULT 0,
  impuesto_total DECIMAL(10,2) DEFAULT 0,
  total DECIMAL(10,2) NOT NULL,
  estado BOOLEA
