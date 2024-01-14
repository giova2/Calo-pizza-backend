# # Dockerfile

FROM node:20-alpine3.18 as front

WORKDIR /app

COPY . .

# Instala las dependencias de Node.j
RUN npm install

# Ejecuta los comandos para compilar assets (si es necesario)
RUN npm run build

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

# Instala las dependencias de Laravel
RUN composer install --no-interaction --no-plugins

FROM nginx:latest as runner

# Crea el directorio snippets
RUN mkdir -p /etc/nginx/snippets

COPY . .
COPY --from=base /app/vendor ./
COPY --from=front /app/node_modules ./
COPY --from=front /app/public/ ./public/

# Copia el archivo fastcgi-php.conf
COPY nginx/fastcgi-php.conf /etc/nginx/snippets/

# Copia la configuración de Nginx
COPY nginx/default.conf /etc/nginx/conf.d/default.conf

# Expone el puerto 9000
EXPOSE 9000
EXPOSE 80
EXPOSE 443

CMD service nginx start && php-fpm
