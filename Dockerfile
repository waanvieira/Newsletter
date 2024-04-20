# FROM php:7.3.6-fpm-alpine3.9
FROM php:8.1-fpm-alpine3.19
RUN apk add --no-cache openssl bash mysql-client nodejs npm alpine-sdk autoconf librdkafka-dev vim nginx openrc
RUN mkdir -p /run/nginx && \
    echo "pid /run/nginx.pid;" >> /etc/nginx/nginx.conf

RUN docker-php-ext-install pdo pdo_mysql bcmath
RUN pecl install rdkafka

RUN ln -s /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini && \
    echo "extension=rdkafka.so" >> /usr/local/etc/php/php.ini

WORKDIR /var/www

#Deletando a pasta HTML que é criada por padrão
RUN rm -rf /var/www/html
#Criando link simbolico
RUN ln -s public html
#Instalando COMPOSER
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# COPY .docker/nginx/nginx.conf /etc/nginx/conf.d
#Copiando a pasta toda para a var/www
# COPY . .

#Copiando o entrypoint para a pasta /
COPY .docker/entrypoint.sh /entrypoint.sh

#Dando permissão máxima para o usuário na pasta storage
# RUN chmod -R 777 /storage

EXPOSE 9000

# RUN chmod +x .entrypoint.sh
