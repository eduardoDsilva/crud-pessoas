# Usando imagem base oficial do PHP com FPM (FastCGI Process Manager)
FROM php:8.2-fpm

# Atualiza o sistema e instala pacotes necessários
RUN apt-get update && apt-get install -y \
    zip unzip curl libzip-dev libpq-dev libonig-dev libxml2-dev \
    libpng-dev libjpeg-dev libfreetype6-dev git \
    && docker-php-ext-configure gd \
        --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl gd bcmath

# Instala o Composer diretamente da imagem oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho da aplicação
WORKDIR /var/www

COPY docker/php/entrypoint.sh /usr/local/bin/entrypoint.sh
ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]
