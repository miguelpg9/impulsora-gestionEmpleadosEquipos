CREATE DATABASE GestionEquipos;
GO

USE GestionEquipos;
GO

--Tabla Departamentos
CREATE TABLE departamentos (
	idDepartamento INT PRIMARY KEY IDENTITY(1,1),
	nombreDepartamento NVARCHAR(100) NOT NULL
);
GO

--Tabla Empleados
CREATE TABLE empleados (
    idEmpleado INT PRIMARY KEY IDENTITY(1,1),
    nombreEmpleado NVARCHAR(100) NOT NULL,
    apellidoPaterno NVARCHAR(100) NOT NULL,
    apellidoMaterno NVARCHAR(100) NOT NULL,
    correo NVARCHAR(150) NOT NULL,
    idDepartamento INT NOT NULL,
    CONSTRAINT FK_Empleado_Departamento FOREIGN KEY (idDepartamento) REFERENCES departamentos(idDepartamento)
);
GO

CREATE TABLE tipoEquipo (
    idTipo INT PRIMARY KEY IDENTITY(1,1),
    nombreTipo NVARCHAR(50) NOT NULL UNIQUE
);
GO

CREATE TABLE equipos (
    idEquipo INT PRIMARY KEY IDENTITY(1,1),
    nombreEquipo NVARCHAR(100) NOT NULL,
    idTipo INT NOT NULL,
    serie NVARCHAR(30) NOT NULL,
    responsableId INT NOT NULL,
    CONSTRAINT fkEquipoResponsable FOREIGN KEY (responsableId) REFERENCES empleados(idEmpleado),
    CONSTRAINT fkEquipoTipo FOREIGN KEY (idTipo) REFERENCES tipoEquipo(idTipo),
    CONSTRAINT UC_Serie_Equipo UNIQUE(serie)
);
GO

-- Insertar departamentos
INSERT INTO departamentos (nombreDepartamento) VALUES
('Sistemas'),
('Recursos Humanos'),
('Contabilidad'),
('Ventas'),
('Auditoría'),
('Mercadotecnia'),
('Producción')
GO

-- Insertar empleados
INSERT INTO empleados (nombreEmpleado, apellidoPaterno, apellidoMaterno, correo, idDepartamento) VALUES
('Miguel', 'Pacheco', 'Pacheco', 'miguel.pacheco@mail.com', 1),
('Melissa', 'Willis', 'Gamiz', 'melissa.willis@mail.com', 1),
('Luis', 'Gómez', 'Torres', 'luis.gomez@mail.com', 2),
('Carla', 'Díaz', 'Fernández', 'carla.diaz@mail.com', 2),
('Andrés', 'Santos', 'Mendoza', 'andres.santos@mail.com', 2),
('Lucía', 'Fernández', 'Lara', 'lucia.fernandez@mail.com', 3),
('Ricardo', 'Molina', 'Pérez', 'ricardo.molina@mail.com', 3),
('Valeria', 'Núñez', 'Rojas', 'valeria.nunez@mail.com', 3),
('Daniel', 'Ortiz', 'Vargas', 'daniel.ortiz@mail.com', 3),
('Sofía', 'Cruz', 'Gutiérrez', 'sofia.cruz@mail.com', 4),
('Jorge', 'Ramírez', 'Alonso', 'jorge.ramirez@mail.com', 4),
('Elena', 'Suárez', 'Morales', 'elena.suarez@mail.com', 4),
('Marco', 'Pérez', 'Aguilar', 'marco.perez@mail.com', 5),
('Diana', 'Herrera', 'Jiménez', 'diana.herrera@mail.com', 5),
('Gabriel', 'Vega', 'Rosales', 'gabriel.vega@mail.com', 6),
('Natalia', 'Campos', 'Reyes', 'natalia.campos@mail.com', 7),
('Iván', 'Flores', 'Carrillo', 'ivan.flores@mail.com', 7),
('Adriana', 'Navarro', 'Castro', 'adriana.navarro@mail.com', 7),
('Raúl', 'Silva', 'Escobar', 'raul.silva@mail.com', 7),
('Camila', 'Medina', 'Salas', 'camila.medina@mail.com', 7);

--Insertar tipos de equipo
INSERT INTO tipoEquipo (nombreTipo) VALUES 
('Laptop'),
('Teléfono');
GO

--Insertar Equipos
INSERT INTO equipos (nombreEquipo, idTipo, serie, responsableId) VALUES
('Laptop Dell', 1, 'LAPX001', 1),
('Laptop Dell', 1, 'LAPX002', 2),
('Laptop Lenovo ThinkPad', 1, 'LAPX003', 3),
('Laptop MacBook Pro', 1, 'LAPX004', 4),
('Laptop MacBook Pro', 1, 'LAPX005', 5),
('Laptop MacBook Pro', 1, 'LAPX006', 6),
('Laptop MacBook Air', 1, 'LAPX007', 7),
('Laptop Lenovo ThinkPad', 1, 'LAPX008', 8),
('Laptop MacBook Air', 1, 'LAPX009', 9),
('Laptop Lenovo ThinkPad', 1, 'LAPX010', 10),
('Laptop MacBook Air', 1, 'LAPX011', 11),
('Laptop Lenovo ThinkPad', 1, 'LAPX012', 12),
('Laptop MacBook Pro', 1, 'LAPX013', 13),
('Laptop Lenovo ThinkPad', 1, 'LAPX014', 14),
('Laptop Lenovo ThinkPad', 1, 'LAPX015', 15),
('Laptop MacBook Air', 1, 'LAPX016', 16),
('Laptop Lenovo ThinkPad', 1, 'LAPX017', 17),
('Laptop MacBook Pro', 1, 'LAPX018', 18),
('Laptop Lenovo ThinkPad', 1, 'LAPX019', 19),
('Laptop Lenovo ThinkPad', 1, 'LAPX020', 20),
('Teléfono iPhone 13', 2, 'TELX001', 1),
('Teléfono Samsung Galaxy S21', 2, 'TELX002', 2),
('Teléfono Xiaomi Mi 11', 2, 'TELX003', 3),
('Teléfono Google Pixel 6', 2, 'TELX004', 4),
('Teléfono OnePlus 9', 2, 'TELX005', 5),
('Teléfono Motorola Edge', 2, 'TELX006', 6),
('Teléfono Nokia G20', 2, 'TELX007', 7),
('Teléfono Sony Xperia 10', 2, 'TELX008', 8),
('Teléfono Oppo Reno6', 2, 'TELX009', 9),
('Teléfono Realme 8 Pro', 2, 'TELX010', 10);
GO