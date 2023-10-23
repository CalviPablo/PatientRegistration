# Patient Registration Backend Challenge - LightIT

## Descripcion del proyecto
El objetivo de este proyecto es crear una aplicación de registro de pacientes utilizando el framework Laravel.
La aplicacion proporciona una API para el registro, valida los datos ingresados por el usuario y los guarda en una base de datos, y envia un correo de confirmacion.
El proyecto esta configurado en el entorno de desarrollo Docker.


## Requisitos para la instalacion
1. Tener git instalado.
2. Tener docker instalado.
3. Tener composer instalado.

## Entorno de desarrollo - Setup

1. Clonar proyecto
- `git clone https://github.com/CalviPablo/PatientRegistration.git` 
2. Instalar las dependencias
- `composer install` 
3. Crear el archivo de variables de entorno: cp .env.example .env
- `cp .env.example .env` 
4. Levantar los contenedores: 
- `sail up --build`
5. Acceder al contenedor de sail para correr las migraciones de las tablas de la BD: docker exec -it <Numero de contenedor> bash
- `docker exec -it <Numero de contenedor> bash`
6. Correr las migraciones: php artisan migrate
- `php artisan migrate`
7. Probar la API a traves de Postman, en el siguiente link esta la documentacion de Postman.
[PostmanAPI](https://documenter.getpostman.com/view/16444122/2s9YRCVqxs)
## Troubleshooting
1. En caso de no poder instalar las dependencias correr el comando: composer install --ignore-platform-reqs

