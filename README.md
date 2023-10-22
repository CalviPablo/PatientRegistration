# Patient Registration Backend - LightIT

## Descripcion del proyecto

## Requisitos para la instalacion
1. Tener git instalado.
2. Tener docker instalado.
3. Tener composer instalado.

## Entorno de desarrollo - Setup

1. Clonar proyecto: git clone https://github.com/CalviPablo/PatientRegistration.git
2. Instalar las dependencias: composer install
3. Crear el archivo de variables de entorno: cp .env.example .env
4. Levantar los contenedores: docker compose up -d
5. Acceder al contenedor de sail para correr las migraciones de las tablas de la BD: 
6. Configurar la base de datos: php artisan migrate|

## Troubleshooting
1. En caso de no poder instalar las dependencias correr el comando: composer install --ignore-platform-req
// Link 
[Create](https://docs.gitlab.com/ee/user/project/repository/web_editor.html#create-a-file)

// viñeta
- `docker-compose exec db mysql -u root -p` 

//Command box with copy
```
docker-compose up -d
```

npm install --save babel-runtime


#	h1
##	h2
#####	h5
*Text* | _Text_	Italic
**text** | __text__	Bold
``` javascript
console.log(foo(5));
```	Code
[name](http:/www....)	Link
![name](http:/www....)	Image
+ Item 1
+ Item 2	List
<ins>Text</ins>	Underline
<br>	Enter
