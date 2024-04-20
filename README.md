<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## Como rodar o projeto

Copiar o arquivo .env-example a pasta raiz e renomea-lo para .env

Criar uma rede docker 

docker network create newsletter-network

Dar permissão ao mysql

docker-compose exec app-mysql chown -R mysql:mysql .

Depois da rede criada rodar o comando

docker-compose up -d

Acessar

http://localhost:9003/

Entrar no container

docker-compose exec app bash

rodar o entrypoint

./entrypoint.sh

Rodar a seed

php artisan db:seed

Rodar teste do PHPUNIT

vendor/bin/phpunit

Rodar teste do Laravel

php artisan test

## Extensões

