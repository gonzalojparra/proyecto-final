# Zen Kicks

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

Proyecto full-stack de competencias de taekwondo.

![Zen Kicks](https://github.com/gonzalojparra/proyecto-final/blob/main/public/image/zenkicks.png)

## Instalación

- Clonar proyecto

```
git clone https://github.com/gonzalojparra/proyecto-final/
```

- Instalar dependencias del composer.json y package.json

```
npm install && npm run dev
```

- Crear una base de datos y configurar el archivo .env

```
DB_CONNECTION=<tu_conexion>
DB_HOST=<tu_host>
DB_PORT=<tu_puerto>
DB_DATABASE=<database_nombre>
DB_USERNAME=<tu_username>
DB_PASSWORD=<tu_password>
```

- Ejecutar migraciones y llenar la database con datos de los seeder

```
php artisan migrate --seed
```

- Ejecutar proyecto

```
php artisan serve
```

- Usuario admin

```
email: admin@admin.com
password: admin
```

- De haber algún error en el servidor, cortar la ejecución del mismo y ejecutar en consola

```
php artisan key:generate
php artisan cache:clear
composer dump-autoload
```

## Autores

- Martina Rosales [@martinaRosales](https://github.com/martinaRosales)
- Laureano Luna [@LaureanoLuna](https://github.com/LaureanoLuna)
- Lucas Martin [@lucasmartin97](https://github.com/lucasmartin97)
- Victoria Perez [@VictoriaPerezG](https://github.com/VictoriaPerezG)
- Jerónimo Rojo [@JeronimoRojo](https://github.com/JeronimoRojo)
- Gonzalo Parra [@gonzalojparra](https://github.com/gonzalojparra)
