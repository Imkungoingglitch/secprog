# IT Helpdesk - PHP 8.3 + Apache
FROM php:8.3-apache

# Ekstensi PHP: pdo_mysql (database) & gd (olah gambar foto profil)
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libpng-dev libjpeg62-turbo-dev libwebp-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-jpeg --with-webp --with-freetype \
    && docker-php-ext-install -j"$(nproc)" pdo_mysql gd \
    && rm -rf /var/lib/apt/lists/*

# Modul Apache
RUN a2enmod headers rewrite

# Konfigurasi PHP & Apache (hardening)
COPY docker/php/php.ini /usr/local/etc/php/conf.d/zz-helpdesk.ini
COPY docker/apache/zz-hardening.conf /etc/apache2/conf-available/zz-hardening.conf
RUN a2enconf zz-hardening

# Source code aplikasi
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html/uploads

EXPOSE 80
