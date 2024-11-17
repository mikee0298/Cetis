-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS CETIS148;

-- Seleccionar la base de datos
USE CETIS148;

-- Crear la tabla de Alumnos
CREATE TABLE Alumnos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    telefono VARCHAR(15)
);

-- Crear la tabla de Mediciones de pH
CREATE TABLE Mediciones_pH (
    id INT PRIMARY KEY AUTO_INCREMENT,
    alumno_id INT,
    valor_pH FLOAT NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (alumno_id) REFERENCES Alumnos(id) ON DELETE CASCADE
);

-- Crear la tabla de Login
CREATE TABLE Login (
    id INT PRIMARY KEY AUTO_INCREMENT,
    alumno_id INT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    FOREIGN KEY (alumno_id) REFERENCES Alumnos(id) ON DELETE CASCADE
);
