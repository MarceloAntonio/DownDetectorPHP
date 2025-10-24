# Usa uma imagem PHP com Apache
FROM php:8.2-apache

# Instala a extensão cURL
RUN apt-get update && \
    apt-get install -y libcurl4-openssl-dev && \
    docker-php-ext-install curl

# (Opcional) habilita o mod_rewrite do Apache
RUN a2enmod rewrite

# Copia o projeto para o diretório do servidor
COPY ./src /var/www/html

# Define o diretório de trabalho
WORKDIR /var/www/html

# Define permissões
RUN chown -R www-data:www-data /var/www/html

# Expõe a porta 80
EXPOSE 80
