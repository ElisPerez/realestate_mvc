# RealEstate MVC width Docker

Docker with Apache, MySQL 8.0.34, PHP 8.0.0, Composer (getcomposer.org)

# Docker:

Es una plataforma de virtualización a nivel de sistema operativo que permite empaquetar, distribuir y ejecutar aplicaciones en contenedores.
Docker se utiliza principalmente para crear y administrar entornos de desarrollo y producción.

## Containers:

Los contenedores son entornos aislados que contienen todo lo necesario para ejecutar una aplicación, incluidas las dependencias y configuraciones.

## Dockerfile:

Un Dockerfile es un archivo de texto que contiene instrucciones **para construir una imagen Docker**. Define cómo se crea una imagen desde una base y cómo se instalan las dependencias y se configuran los elementos en esa imagen.

## docker-compose.yml:

Un archivo docker-compose.yml es utilizado para definir y gestionar múltiples servicios, redes y volúmenes en un entorno de Docker. Puedes usarlo para orquestar contenedores basados en las imágenes definidas en los Dockerfiles o en imagenes de hub.docker.com

- Servicio:
  Un servicio en docker-compose.yml es una definición de cómo se ejecuta un contenedor específico. Aquí puedes configurar la imagen, puertos expuestos, variables de entorno, volúmenes compartidos, enlaces entre contenedores y más.
- Volume:
  Un volume es un mecanismo para persistir y compartir datos entre contenedores y el host. Puedes usar volúmenes para mantener datos que deben sobrevivir a la vida del contenedor.
- Red:
  Una NETWORK en Docker es un espacio aislado en el cual los contenedores pueden comunicarse entre sí. Puedes definir redes personalizadas para aislar y conectar contenedores.

# Usage

Use docker-compose as orchestrator. To run these containers:

```
docker-compose up -d
```

Stop and delete containers:

```
docker-compose down
```

Delete all (Containers, volumes and Images):

```
docker compose down --volumes --rmi all
```

# Eliminar CACHE de BUILDS anteriores en Docker:

- `docker builder prune`

# Eliminar CACHE de TODO:

- `docker system prune`:

Open phpmyadmin at [http://127.0.0.1:8000](http://127.0.0.1:8000)

Open web browser with yout project at [http://127.0.0.1:80](http://127.0.0.1:80)

## Run MySQL client:

- `docker compose exec db mysql -u root -p`

# RUM commands in other services:

- `docker exec -it www sh`: Entra en la consola interactiva del servicio `www`.

  - Ejemplo: Ver DNS `cat /etc/resolv.conf`
  - Modificar DNS: `echo "nameserver 8.8.8.8" > /etc/resolv.conf && echo "nameserver 8.8.4.4" >> /etc/resolv.conf`

- `docker compose config --services`: Muestra la lista de los nombres de los servicios

### Dos maneras de ejecutar un comando:

- `docker exec <service_name> <command_to_run>`: Sin la palabra compose.
- `docker compose exec <service_name> <command_to_run>`: Con la palabra compose.
  - Example: `docker compose exec node npm install` or `docker exec www composer update`

# Run sh in the `www` container:

- `docker exec -it www sh`

# Run bash in the `www` container:

- `docker exec -it www bash`: Al usar el tag "www" no hay que buscar el id con `docker ps`. Asi que Cada vez que se genere un nuevo container con un nuevo ID tendrá el tag www. Fácil, fácil. 😎

## Mostrar containers inactivos:

- `docker ps -a -f "status=exited"`: --filter se abrevia con solo -f

### Infrastructure model

![Infrastructure model](/docker/.infragenie/infrastructure-model-docker.png)

## dump directory

- En el archivo docker-compose.yml, estamos usando el volumen mapeado `./dump:/docker-entrypoint-initdb.d`, lo que significa que cualquier archivo SQL que coloquemos en el directorio local "dump" se copiará automáticamente al directorio /docker-entrypoint-initdb.d en el contenedor de MySQL cuando se inicie.
- Estos archivos SQL se ejecutarán automáticamente durante el proceso de inicio de MySQL y cargarán los datos en la base de datos.
- El nombre "dump" en este contexto se refiere al directorio local que contiene archivos SQL para inicializar la base de datos MySQL.

## Composer commands

- `composer init`: Inicia la creacion del composer.json (tipo package.json de npm init).
- `composer update`: Despues de que realicemos un cambio al composer.json debemos actualizar con este comando.
- La carpeta `vendor` es el equivalente a la carpeta `node_modules` en NPM.

# Notas de PHP

- La función `mysqli_fetch_assoc` devuelve una fila de la tabla cada vez que se llame. Cuando se acaban las filas devuelve null.

# Errores al Eliminar un registro en la DB desde /admin (Eliminando un Vendedor)

## Se intenta eliminar un registro y aunque parece que todo sale bien no afectó la tabla en db asi que sigue apareciendo el registro que se intentó borrar. El error a continuación no se vé desde la aplicacion sino intentando hacer el query directamente en el programa TablePlus.

- Error: Query 1: Cannot delete or update a parent row: a foreign key constraint fails (`realestate`.`properties`, CONSTRAINT `fk_properties_sellers` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`))
  - Este error indica que no se puede eliminar este registro debido a la existencia de uno o más registros en otra tabla (properties) que tienen una relación con el ID del vendedor.
  - Para resolverlo, es necesario eliminar los registros relacionados en la tabla hija (properties) antes de eliminar el registro en la tabla padre (sellers).
    - En este caso, la tabla `sellers` es la tabla PADRE de `properties`.


# Enviroment Variable
 - Se instaló con COMPOSER la librería 'vlucas/phpdotenv'.
 - Se cargaron las variables de entorno en el archivo `/includes/app.php`
 - Ahora se puede acceder a las Variables de Entorno con las super globales `$_ENV['VARIABLE_NAME']` Y `$_SERVER['VARIABLE_NAME']`