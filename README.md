# WebEntradasOlimpiadas

Este proyecto es una aplicación web para gestionar las entradas a las Olimpiadas. El proyecto se divide en dos partes principales: el backend y el frontend. El backend está construido con Symfony y el frontend con Ionic y Angular.

## Backend

El backend está construido con Symfony y se encuentra en la carpeta `BackendOlimpiadas`. En el controlador `LanzadorSorteoController`, hay una función `doSorteo` que realiza un sorteo entre los usuarios. Esta función se puede llamar a través de la API en la ruta `/api/lanzador/sorteo`.

Para ejecutar el backend, primero es necesario instalar las dependencias con el siguiente comando:
```bash
composer install
```
Una vez instaladas las dependencias, se puede ejecutar el backend con el siguiente comando:
```bash
symfony server:start
```
Esto iniciará el servidor de desarrollo de Symfony.

## Frontend

El frontend parece estar construido con Ionic y Angular.
Para ejecutarlo, antes de nada, es necesario instalar las dependencias con el siguiente comando:
```bash
npm install
```
Una vez instaladas las dependencias, se puede ejecutar el frontend con el siguiente comando:
```bash
ionic serve
```
Esto abrirá una ventana en el navegador con la aplicación web.

## Pruebas

Para probar la API, puedes usar la colección Postman proporcionada en el archivo `EntradasOlimpiadas.postman_collection.json`.

## Notas

La parte para que se ejecute solo si es el último día del mes de marzo está comentada para que se pueda ejecutar la prueba más adelante.

## Autor
- [Mikel Echeverria](https://github.com/byronnDev)
- [Aitor Gorostizu](https://github.com/resail)
- [Juan Hidalgo](https://github.com/JHSprogramador)
- [Xabier Muro](https://github.com/XabierMuro)
- [Oroz]()