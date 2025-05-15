# Agenda PHP con Gestión de Usuarios y Contactos

Este proyecto es una **agenda web desarrollada en PHP** que permite:
- Iniciar sesión como administrador o usuario.
- Ver, agregar, editar y eliminar contactos.
- Actualizar los datos del usuario autenticado.

## Tecnologías utilizadas

- PHP (sin frameworks)
- MySQL
- HTML, CSS, JavaScript (vanilla)
- AJAX para la edición y eliminación en tiempo real

## Estructura del proyecto MVC

AgendaPHPConActualizar/
├── AccesoDatos.php
├── Usuario.php
├── inicio.php
├── login.php
├── cerrarSesion.php
├── actualizarUsuario.php
├── editarContacto.js
├── eliminarContacto.js
├── style.css
├── estilo.css
├── database/
│   └── agenda.sql
```

## 🛠️ Instalación y ejecución

### 1. Clona el repositorio

```bash
git clone https://github.com/tu-usuario/AgendaPHPConActualizar.git
cd AgendaPHPConActualizar
```

### 2. Importa la base de datos

1. Abre tu gestor de bases de datos (phpMyAdmin, DBeaver, consola, etc.).
2. Crea una nueva base de datos, por ejemplo: 'agenda'.
3. Importa el archivo SQL ubicado en 'database/agenda.sql'.

**Consola MySQL:**
bash
mysql -u usuario -p agenda < database/agenda.sql


### 3. Configura la conexión a la base de datos

Edita el archivo `AccesoDatos.php` y reemplaza los datos de conexión:

php
$host = "localhost";
$dbname = "agenda";
$user = "root";
$password = "";


### 4. Ejecuta el sistema

Coloca el proyecto en la carpeta `htdocs` de XAMPP o tu servidor local:


C:\xampp\htdocs\AgendaPHPConActualizar


Abre en tu navegador:


http://localhost/AgendaPHPConActualizar/index.php


## Usuarios por defecto

| Usuario  | Contraseña | Tipo         |
|----------|------------|--------------|
| admin01  | adminpass  | administrador|
| manolo   | pass456    | usuario      |

## Funcionalidades

- Login de usuario con verificación de tipo.
- CRUD de contactos (nombre, teléfono, correo, etc.).
- Edición mediante formulario emergente (modal).
- Eliminación con confirmación vía JavaScript.
- Opción para actualizar tus datos como usuario.
