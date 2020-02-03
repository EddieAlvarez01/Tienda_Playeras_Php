CREATE DATABASE db_shop_master;
USE db_shop_master;

CREATE TABLE Rol(
	id INT AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    CONSTRAINT pk_rol PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE Categoria(
	id INT AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    CONSTRAINT pk_categoria PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE Usuario(
	id INT AUTO_INCREMENT,
    rol_id INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    password VARCHAR(200) NOT NULL,
    imagen VARCHAR(200),
    CONSTRAINT pk_usuario PRIMARY KEY(id),
    CONSTRAINT fk_usuario_rol FOREIGN KEY(rol_id) REFERENCES Rol(id),
    CONSTRAINT uq_correo UNIQUE(correo)
)ENGINE=InnoDB;

CREATE TABLE Producto(
	id INT AUTO_INCREMENT,
    categoria_id INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    descripcion MEDIUMTEXT,
    precio DECIMAL(20, 2) NOT NULL,
    stock INT NOT NULL,
    oferta VARCHAR(100),
    fecha DATETIME NOT NULL,
    imagen VARCHAR(200),
    CONSTRAINT pk_producto PRIMARY KEY(id),
    CONSTRAINT fk_producto_categoria FOREIGN KEY(categoria_id) REFERENCES Categoria(id)
)ENGINE=InnoDB;

CREATE TABLE Pedido(
	id INT AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    provincia VARCHAR(100) NOT NULL,
    localidad VARCHAR(100) NOT NULL,
    direccion VARCHAR(150) NOT NULL,
    coste DECIMAL(20, 2) NOT NULL,
    estado VARCHAR(50),
    fecha DATETIME NOT NULL,
    CONSTRAINT pk_pedido PRIMARY KEY(id),
    CONSTRAINT fk_pedido_usuario FOREIGN KEY(usuario_id) REFERENCES Usuario(id)
)ENGINE=InnoDB;

CREATE TABLE Detalle_Pedido(
	pedido_id INT NOT NULL,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL,
    CONSTRAINT fk_detalle_pedido FOREIGN KEY(pedido_id) REFERENCES Pedido(id),
    CONSTRAINT fk_detalle_producto FOREIGN KEY(producto_id) REFERENCES Producto(id) 
)ENGINE=InnoDB;

INSERT INTO Rol(nombre)
VALUES('administrador');
INSERT INTO Rol(nombre)
VALUES('cliente');

INSERT INTO Usuario(rol_id, nombre, apellidos, correo, password)
VALUES(1, 'admin', 'admin', 'admin@admin.com', '$2y$10$RIFKcRQJE4T4KTxtlgFYheq.cnBve8bCxquQSQ..KMZBi50DswpPu');

INSERT INTO Categoria(nombre)
VALUES('Manga corta');
INSERT INTO Categoria(nombre)
VALUES('Tirantes');
INSERT INTO Categoria(nombre)
VALUES('Manga larga');
INSERT INTO Categoria(nombre)
VALUES('Sudaderas');

