#!/bin/bash

# Corrige permissões
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Executa o comando original do container (php-fpm)
exec "$@"

