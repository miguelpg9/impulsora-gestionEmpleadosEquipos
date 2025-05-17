#  Sistema de Gestión de Empleados y Equipos

Este proyecto es un sistema **CRUD completo** desarrollado con **PHP**, **JavaScript**, **Bootstrap** y **SweetAlert2**, diseñado para gestionar empleados y los equipos a los que pertenecen dentro de una organización.

---

## 🚀 Funcionalidades

- Registrar empleados y equipos
- Editar información de empleados
- Asignar equipos a empleados
- Eliminar empleados y equipos con confirmación
- Ver tablas dinámicas y responsivas
- Formularios con validaciones del lado del cliente

---

## Tecnologías utilizadas

- **PHP**
- **JavaScript**
- **Bootstrap 5** – interfaz moderna y adaptable
- **SweetAlert2** – alertas elegantes y confirmaciones
- **SQL SERVER** – almacenamiento de datos relacional

---

##  Estructura del proyecto
/proyecto-empleados-equipos/
│
├── index.php
├── empleados/
│ ├── listar.php
│ ├── crear.php
│ ├── editar.php
│ └── eliminar.php
├── equipos/
│ ├── listar.php
│ ├── crear.php
│ ├── editar.php
│ └── eliminar.php
├── db/
│ ├── conexion.php
│ └── init.sql
├── assets/
│ ├── css/
│ ├── js/
│ └── libs/ (Bootstrap, SweetAlert)
└── README.md

## Instrucciones de instalación y ejecución
    ### Requisitos previos:
        Antes de comenzar, asegúrate de tener instalado lo siguiente en tu máquina:
        - XAMPP o similar (Apache + MySQL + PHP)
        - Navegador web actualizado (Chrome, Firefox, etc.)
        - Editor de código (opcional, recomendado: VS Code)

    ### Instalacion
    1 - Clona o descarga el proyecto
        git clone https://github.com/tu-usuario/gestion-empleados-equipos.git
    
    2 - Ubica el proyecto en la carpeta de tu servidor
        C:\xampp\htdocs\gestion-empleados-equipos
    
    3 - Modifica tu cadena de conexion en el archivo db/Conexion.php

    4 - Activa tu servidor xampp y entra a la ruta http://localhost/gestion-empleados-equipos/index.php

## Autor y contacto

- Miguel Antono Pacheco García 
- miguelpg89.mp@gmail.com