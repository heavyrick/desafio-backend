# Desafio Back-End - OW Interactive 20/21

#### Informações básicas

- Desenvolvido com Apache/2.4.39, PHP 7.3.7, Laravel 7.25.0, MariaDB 10.3.16 e Composer
- Criar database `ow_desafio` ou alterar o nome do arquivo no arquivo `.env`

Seguir os passos para instalação:

### Criar projeto

\$ git clone https://github.com/heavyrick/desafio-backend.git

\$ cd /desafio-backend/backend/

\$ composer install

\$ php artisan serve

### Migrations

\$ php artisan migrate

### Seed

\$ php artisan db:seed

### Habilitar o passport

\$ php artisan passport:install

\$ php artisan passport:keys

### Limpeza de cache

\$ php artisan cache:clear

\$ php artisan config:clear

\$ composer dump-autoload

## Documentação da API

Documentação elaborada no postman
[Postman](https://documenter.getpostman.com/view/1636800/TVCY5rSw)

> Obs:

- Os posts e put de dados, foram feitos na tab `Body`, na opção `x-www-form-urlencoded`;
- A url base usada foi a `http://127.0.0.1:8000` criada pelo comando `php artisan serve`.
