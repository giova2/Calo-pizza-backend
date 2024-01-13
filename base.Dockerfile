# Utiliza una imagen base con PHP y Composer
FROM php:8.2-fpm-alpine as base

# Establece el directorio de trabajo en la aplicación Laravel
WORKDIR /app

# Copia los archivos de la aplicación Laravel al contenedor
COPY . .

# Instala las dependencias de Composer
RUN apk update && \
    apk add \
        git \
        unzip \
        libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
