<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# CRUD de Estudiantes

Aplicación CRUD básica desarrollada con **Laravel 13** y **PostgreSQL** para la gestión de estudiantes.

## Funcionalidades

- **Crear** — Registrar nuevos estudiantes con código, nombres, apellidos, edad y correo
- **Listar** — Visualizar todos los estudiantes en una tabla
- **Actualizar** — Editar la información de un estudiante existente
- **Eliminar** — Eliminar un estudiante del sistema

## Tecnologías

- Laravel 13
- PHP 8.3+
- PostgreSQL
- Bootstrap 4
- jQuery

## Requisitos

- PHP >= 8.3
- Composer
- PostgreSQL
- Node.js (para compilar assets con Vite)

## Instalación

```bash
# Clonar el repositorio
git clone <repo-url>
cd CRUD

# Instalar dependencias de PHP
composer install

# Copiar archivo de entorno y generar APP_KEY
cp .env.example .env
php artisan key:generate

# Configurar la base de datos en .env
# DB_CONNECTION=pgsql
# DB_DATABASE=pilot_crud
# DB_USERNAME=postgres
# DB_PASSWORD=postgres

# Ejecutar migraciones
php artisan migrate

# Instalar dependencias frontend y compilar
npm install
npm run build

# Iniciar servidor
php artisan serve
```

## Rutas

| Método | URI | Acción |
|--------|-----|--------|
| GET | `/` | Página de inicio |
| GET | `/students` | Listar estudiantes |
| POST | `/students` | Crear estudiante |
| PUT/PATCH | `/students/{id}` | Actualizar estudiante |
| DELETE | `/students/{id}` | Eliminar estudiante |

## Licencia

[MIT](https://opensource.org/licenses/MIT)
