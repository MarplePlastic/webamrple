# Imagen PHP + Apache con las extensiones que usa el panel admin de Marple
FROM php:8.3-apache

# Extensiones: MySQL (PDO), GD (imágenes), mbstring
RUN apt-get update && apt-get install -y --no-install-recommends \
        libpng-dev libjpeg-dev libfreetype6-dev libonig-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" pdo_mysql gd mbstring \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Permitir .htaccess (URLs limpias, seguridad)
RUN sed -ri 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Límites de subida para CV/imágenes
RUN { \
      echo 'upload_max_filesize=8M'; \
      echo 'post_max_size=10M'; \
      echo 'max_execution_time=60'; \
    } > /usr/local/etc/php/conf.d/marple.ini

WORKDIR /var/www/html
