# 🚀 CRUD de Usuarios - Backend Laravel

## 📋 Descripción
Backend completo para sistema de gestión de usuarios desarrollado en Laravel. Provee API RESTful para operaciones CRUD (Crear, Leer, Actualizar, Eliminar) con autenticación y validaciones.

## 🛠️ Tecnologías Utilizadas
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![XAMPP](https://img.shields.io/badge/XAMPP?style=for-the-badge&logo=xampp&logoColor=white)

## 📸 Capturas de Pantalla

### Estructura de Base de Datos

![Base de Datos](docs/back1.png)

### API Endpoints en Insomnia

#### GET - Listar Usuarios
![API Endpoints](docs/back3.png)

#### POST - Crear Usuario
![API Endpoints](docs/back2.png)

#### GET - Ver Usuario
![API Endpoints](docs/back4.png)

#### PUT - Actualizar Usuario
![API Endpoints](docs/back5.png)

#### DELETE - Eliminar Usuario
![API Endpoints](docs/back6.png)

## 🚀 Instalación Rápida

### Prerrequisitos
- PHP 8.2 o superior
- Composer
- MySQL
- XAMPP 

### Pasos de Instalación
```bash
# Clonar el repositorio
git clone https://github.com/itzelmb6/user_crud_backend.git
cd user-crud-backend

# Instalar dependencias
composer install

# Configurar ambiente
cp .env.example .env

# Configurar base de datos en .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=users_crud
DB_USERNAME=root
DB_PASSWORD=

# Ejecutar migraciones
php artisan migrate

# Iniciar servidor
php artisan serve
