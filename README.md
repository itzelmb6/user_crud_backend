# 🚀 CRUD de Usuarios - Backend Laravel

## 📋 Descripción
Backend completo para sistema de gestión de usuarios desarrollado en Laravel. Provee API RESTful para operaciones CRUD (Crear, Leer, Actualizar, Eliminar) con autenticación y validaciones.

## 🛠️ Tecnologías Utilizadas
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![API](https://img.shields.io/badge/API-RESTful-green?style=for-the-badge)

## 📸 Capturas de Pantalla

### API Endpoints en Insomnia
<!-- AGREGAR CAPTURA DE INSOMNIA AQUÍ -->
![API Endpoints](images/insomnia-api.png)

### Estructura de Base de Datos
<!-- AGREGAR CAPTURA DE PHPMYADMIN AQUÍ -->
![Base de Datos](images/database-structure.png)

### Código del Controlador
<!-- AGREGAR CAPTURA DEL CÓDIGO AQUÍ -->
![Código Laravel](images/laravel-code.png)

## 🚀 Instalación Rápida

### Prerrequisitos
- PHP 8.2 o superior
- Composer
- MySQL
- XAMPP (recomendado)

### Pasos de Instalación
```bash
# Clonar el repositorio
git clone https://github.com/tu-usuario/user-crud-backend.git
cd user-crud-backend

# Instalar dependencias
composer install

# Configurar ambiente
cp .env.example .env

# Configurar base de datos en .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=user_crud
DB_USERNAME=root
DB_PASSWORD=

# Generar clave de aplicación
php artisan key:generate

# Ejecutar migraciones
php artisan migrate

# Iniciar servidor
php artisan serve
