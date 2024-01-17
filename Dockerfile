# Dockerfile
# Use base image for container
FROM richarvey/nginx-php-fpm:3.1.6

# Copy all application code into your Docker container
COPY . .

RUN apk update

# Install the `npm` package
RUN apk update && \
    apk add --no-cache npm \
    git \
    unzip \
    libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql

# Install NPM dependencies
RUN npm install

# Build Vite assets
RUN npm run build

CMD ["/start.sh"]