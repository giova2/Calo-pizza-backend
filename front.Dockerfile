# Dockerfile

FROM node:20-alpine3.18 as front

WORKDIR /app

COPY . .

# Instala las dependencias de Node.j
RUN npm install

# Ejecuta los comandos para compilar assets (si es necesario)
RUN npm run build