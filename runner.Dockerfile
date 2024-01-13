# # Dockerfile

# FROM node:20-alpine3.18 as front

# WORKDIR /app

# COPY . .

# # Instala las dependencias de Node.j
# RUN npm install

# # Ejecuta los comandos para compilar assets (si es necesario)
# RUN npm run build

# Utiliza una imagen base con PHP y Composer
# FROM php:8.2-fpm-alpine as base
FROM base

# Establece el directorio de trabajo en la aplicación Laravel
WORKDIR /app

# Copia los archivos de la aplicación Laravel al contenedor
COPY . .
COPY --from=front /app/node_modules ./
COPY --from=front /app/public/ ./public/

# # Instala las dependencias de Composer
# RUN apk update && \
#     apk add \
#         git \
#         unzip \
#         libpq-dev && \
#     docker-php-ext-install pdo pdo_pgsql && \
#     curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instala las dependencias de Laravel
RUN composer install --no-interaction --no-plugins

# Expone el puerto 9000
EXPOSE 9000

# Ejecuta el servidor PHP-FPM
CMD ["php-fpm"]
