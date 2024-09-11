<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# API Posnet

## Descripción

La API Posnet permite procesar pagos con tarjetas de crédito. Los usuarios pueden registrar tarjetas de crédito y realizar pagos con ellas. La API maneja la validación de tarjetas, el cálculo de recargos según el número de cuotas, y la verificación del límite disponible de la tarjeta.

## Requisitos del Sistema

- PHP >= 8.0
- Composer
- MySQL
- Laravel >= 9.0

## Instalación

Sigue estos pasos para instalar y configurar el proyecto:

1. Clona el repositorio:

   ```bash
   git clone https://github.com/degreefmariano/posnet_api.git
   ```

2. Ingresa al proyecto:

   ```bash
   cd posnet_api
   ```

3. Copia el archivo **.env.example** a **.env** y configura tus variables de entorno, especialmente las relacionadas con la base de datos:

   ```bash
   cp .env.example .env
   ```

4. Migra la base de datos

   ```bash
   php artisan migrate
   ```

5. Inicia el servidor de desarrollo:

   ```bash
   php artisan serve
   ```

# Uso

## Registrar una Tarjeta

Endpoint: POST /api/card-register

Request:

   ```json
{
    "tipo_tarjeta": "AMEX",
    "entidad_bancaria": "Banco Santa Fe",
    "numero_tarjeta": "87654321",
    "limite_disponible": "500000",
    "dni": "29745686",
    "nombre": "María José",
    "apellido": "López",
    "fecha_expiracion": "11/26",
    "cvv": "306"
}
   ```

Respuesta Exitosa:

 ```json
{
    "estado": "success",
    "data": {
        "tipo_tarjeta": "AMEX",
        "entidad_bancaria": "Banco Santa Fe",
        "numero_tarjeta": "87654321",
        "limite_disponible": "500000",
        "dni": "29745686",
        "nombre": "María José",
        "apellido": "López",
        "fecha_expiracion": "11/26",
        "cvv": "306",
        "updated_at": "2024-09-11T06:03:07.000000Z",
        "created_at": "2024-09-11T06:03:07.000000Z",
        "id": 7
    },
    "message": "Tarjeta guardada exitosamente"
}

   ```

## Realizar un Pago

Endpoint: POST /api/card-pay

Request:

 ```json
{
    "numero_tarjeta": "87654321",
    "monto": "800000",
    "cuotas": "5"
}
```

Respuesta Exitosa:

 ```json
{
    "estado": "success",
    "message": "Pago realizado con éxito",
    "nombre": "María José",
    "apellido": "López",
    "monto_total_a_pagar": 89600,
    "monto_por_cuota": "17,920.00",
    "cuotas": "5"
}
```

Respuesta de Error:

 ```json
{
    "estado": "error",
    "message": "Límite insuficiente para efectuar el pago"
}
```



----

## Pruebas

Las pruebas se realizan utilizando PHPUnit. Se han desarrollado pruebas para verificar los procesos de los pagos con tarjeta de créditos.

Para ejecutar las pruebas, utiliza el siguiente comando:

   ```bash
   php artisan test
   ```

## Arquitectura

El proyecto sigue una arquitectura MVC (Model-View-Controller) típica de Laravel, con código PHP:

<ul>
  <li><b>Models: </b> Definición de las entidades.</li>
  <li><b>Controllers: </b> Gestión de la lógica de negocio y las operaciones.</li>
  <li><b>Routes: </b> Definición de los endpoints de la API.</li>
</ul>

## Notas Adicionales

- **Uso de Postman:** He utilizado Postman para probar los servicios implementados. En la carpeta raíz del proyecto, encontrarás un archivo exportado con los endpoints utilizados durante el desarrollo. Puedes [importar este archivo en Postman](tests/Postman/posnet_api.postman_collection.json) para tener acceso rápido a las rutas implementadas.

- Archivo Postman: [tests/Postman/Proyecto API Posnet.postman_collection.json](tests/Postman/posnet_api.postman_collection.json)

## Estructura Técnica del Proyecto

Este proyecto sigue una estructura organizada y utiliza varias técnicas y patrones para garantizar su mantenibilidad y escalabilidad. A continuación, se describen algunos aspectos técnicos clave:

### API y Controlador

La lógica de la aplicación se organiza a través de una API RESTful implementada en Laravel. Los controladores son responsables de manejar las solicitudes HTTP y gestionar la lógica correspondiente. En particular, se hace un uso extensivo de form requests personalizados para validar y formatear las solicitudes de manera coherente. Además, se definen reglas específicas en estos form requests para garantizar la integridad de los datos. 

En algunos casos, se utilizan form requests personalizados para controlar la validación de las solicitudes de manera más específica. Además, en determinados escenarios, se implementan respuestas personalizadas para ajustar el formato de las respuestas de la API según los requisitos.

<hr>

- [Linkedin Autor](https://linkedin.com/in/mariano-de-greef).  

- [Email Autor](mailto:degreefmariano@gmail.com).
