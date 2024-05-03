# eCommerce Rincon Jabonero (Laravel 11)

## Descarga el proyecto
Descarga el proyecto desde el repositorio de GitHub.

## Instalación
1. Abre la terminal y navega hasta la carpeta del proyecto.
2. Ejecuta el comando `composer install` para instalar las dependencias de PHP.
3. Crea un archivo `.env` en la raíz del proyecto y copia el contenido del archivo `.env.example`.
4. Ejecuta el comando `php artisan key:generate` para generar la clave de la aplicación.

## Base de datos
El proyecto utiliza una base de datos MySQL llamada 'ecommerce_rincon_jabonero'.
Puedes cambiar el nombre de la base de datos en el archivo `.env`.

### Configuración de la base de datos
Accede a la base de datos y crea una base de datos con el nombre que esté indicado en el archivo `.env`.
Configura el archivo `.env` con los datos de tu base de datos.

## Creación de tablas
Ejecuta el comando `php artisan migrate` para crear las tablas de la base de datos.

## Inserción de datos de prueba
Ejecuta el comando `php artisan db:seed` para insertar datos de prueba en la base de datos.