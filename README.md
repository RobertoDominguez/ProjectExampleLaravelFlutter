<p align="center">
    <a href="https://quokasoft.com/" target="_blank">
        <img src="https://quokasoft.com/images/logo-dark.png" width="400">
    </a>
</p>

## Project example 
In this repository you can find an example of project made in MVC laravel and 3 Layers flutter

## Ejemplo de proyecto
En este repositorio puedes encontrar un ejemplo de proyecto realizado en MVC laravel y 3 Capas flutter

## Development environment used
Laravel was used with MVC as the architecture pattern for the backend and Flutter with 3 layers as the architecture pattern for the frontend

## Entorno de desarrollo utilizado
Se utilizo Laravel con MVC como patron de arquitectura para el backend y Flutter con 3 capas como patron de arquitectura para frontend

## Pasos para usar el proyecto en Laravel
# 1) Abrir la terminal y ejecutar "composer install"
# 2) Copiar .env.example como .env
# 3) Abrir la terminal y ejecutar "php artisan key:generate"
# 4) Abrir la terminal y ejecutar "php artisan storage:link"
# 4) Dentro de .env configurar las credenciales de la db
# 5) Abrir la terminal y ejecutar "php artisan migrate:fresh --seed"
# 6) Para crear el servidor local ejecutar "php artisan serve --host=ip --port=8001"

## Pasos para usan el proyecto en flutter
# 1) Abrir la terminar en pubsec.yaml y ejecutar "flutter pub get"
# 2) Ir a lib/env.dart y cambiar el host='http://ip:8001';
# 3) Correr el proyecto, si usamos chrome usar "flutter run -d chrome --web-renderer html"