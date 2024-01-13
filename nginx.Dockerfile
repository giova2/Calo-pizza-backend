# Dockerfile.nginx

# Utiliza la imagen base de Nginx
FROM nginx:latest

# Crea el directorio snippets
RUN mkdir -p /etc/nginx/snippets

# Copia el archivo fastcgi-php.conf
COPY nginx/fastcgi-php.conf /etc/nginx/snippets/

# Copia la configuración de Nginx
COPY nginx/default.conf /etc/nginx/conf.d/default.conf
