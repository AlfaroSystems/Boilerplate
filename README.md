# Boilerplate Premium Laravel Base

Este es un boilerplate optimizado y unificado para proyectos **Laravel 12**. Se enfoca en una experiencia de usuario (UX) premium y una estructura de componentes simplificada, ideal para bases de proyectos que requieren una estética profesional desde el primer momento.

## 🚀 Características Principales

- **Diseño Premium**: Interfaz moderna con soporte completo para modo oscuro (Dark/Light Mode) y transiciones fluidas.
- **Autenticación Unificada**: Vistas de Laravel Breeze rediseñadas y unificadas bajo componentes premium como `x-input`, reduciendo el número de archivos y mejorando la consistencia.
- **Gestión de Roles y Permisos**: Integración robusta lista con **Spatie Laravel Permission**, posibilitando el control de acceso desde el día uno.
- **Simplificación de Componentes**: Estructura de componentes Blade optimizada (`x-card`, `x-input`, `x-primary-button`) para un desarrollo más ágil y mantenible.
- **Base Sólida y Segura**: Configuración lista para **PHP 8.5+**, **PostgreSQL** y **Vite**, respaldada por una extensa batería de pruebas (Feature Tests).

## 🛠️ Instalación y Configuración con Docker

Este proyecto está completamente contenedorizado para garantizar que funcione en cualquier equipo sin necesidad de instalar PHP o PostgreSQL localmente.

### Pasos para el Despliegue

1.  **Preparar el entorno**:
    Copia el archivo de configuración optimizado para Docker:
    ```bash
    cp .env.docker .env
    ```

2.  **Construir y Levantar los Contenedores**:
    ```bash
    docker-compose up -d --build
    ```

3.  **Configurar la Aplicación**:
    ```bash
    docker-compose exec app composer install
    docker-compose exec app php artisan key:generate
    docker-compose exec app php artisan migrate:fresh --seed
    ```

4.  **Frontend**:
    ```bash
    npm install
    npm run build
    ```

5.  **Acceder**: [http://localhost:8000](http://localhost:8000)
    - **Email:** `test@example.com` | **Password:** `password`

## 🐳 Estructura Docker
- **App**: PHP 8.4-fpm | **Web**: Nginx | **DB**: PostgreSQL 15 | **Redis**: Caché.


## 🧪 Ejecución de Pruebas

El boilerplate cuenta con pruebas (tests) completamente configuradas y funcionando con éxito para módulos del sistema y perfiles (gestión de cuentas, reseteos, autenticaciones, etc.). Para correr la suite de pruebas:

```bash
php artisan test
```

## 📦 Estructura de Componentes Principales

- **`x-card`**: Contenedores premium con header y body personalizables.
- **`x-input`**: Componente autónomo que integra de forma conjunta Label, Input y Mensajes de Validación en un solo lugar.
- **`x-primary-button`**: Botones estilizados con interacción (focus/hover/active) moderna de manera consistente.

## 🤝 Estado del Proyecto
Este proyecto ha sido consolidado y pulido para servir como una base de arranque profesional de alto impacto visual. Aporta gran valor eliminando el código repetitivo de los auth scaffolds de Laravel y ofrece una excelente experiencia cohesiva.
