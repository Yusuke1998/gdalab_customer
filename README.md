<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

###### Prueba entrevista FullStack PHP

## Requerimientos minimos

- Php 7.4 o superior.
- Mysql.
- Vs code.
- Composer.
- PhpMyadmin.

## Mi setup local

- Windows 11
- Laragon (php 7.4.3, mysql 8)
- Postman for Windows v10.23.1
- PhpStorm 2023.3.3
- Composer v2.5.8
- DBeaver 23.3.4

## Pasos para correr aplicacion laravel.

- Tener creado el Modelo básico de la BD en mysql.
- Clonar repositorio.
- En la raiz del proyecto hacer un `cp .env.example .env`.
- Correr los comandos `composer install` y `php artisan key:generate`.
- En el archivo .env ajustar los valores de la db segun corresponda a su conf.
```
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
- Correr comando `php artisan migrate` y `php artisan db:seed` esto va a crear unas tablas nuevas necesarias y tambien varios registros de prueba para facilitar la visualizacion de datos.
- Por ultimo correr `php artisan serve`.
- Aqui ajunto la coleccion de postman que utilice durante el desarrollo [collections](https://api.postman.com/collections/6035811-2a039174-3425-492e-84b1-924aa67a2bcd?access_key=PMAT-01HPN1RPEYP1VC46MBYVZE1ZB5).

### Notas.
- El `API_TOKEN` en el archivo .env sera necesario para todas las request que se hagan menos para el login.
- Todas las request y response quedaran trackeadas en la tabla `token_statistics` la cual esta asociada al token obtenido durante el login.
- Si `APP_ENV=production` no se van a loguear las respuestas de las request.
