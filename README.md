# Desafio Back-End - OW Interactive 20/21

#### Informações básicas

- Desenvolvido com Apache/2.4.39, PHP 7.3.7, Laravel 7.25.0, MariaDB 10.3.16 e Composer
- Criar database `ow_desafio` ou alterar o nome do banco de dados no arquivo `.env`

Seguir os passos para instalação:

### Criar projeto

\$ git clone https://github.com/heavyrick/desafio-backend.git

\$ cd desafio-backend/backend

\$ composer install

### Migrate

\$ php artisan migrate

### Seed

\$ php artisan db:seed

### Habilitar o passport (usado para autenticação)

\$ php artisan passport:install

\$ php artisan passport:keys --force

### Iniciar aplicação

\$ php artisan serve

### Limpeza de cache (se necessário)

\$ php artisan cache:clear

\$ php artisan config:clear

\$ composer dump-autoload

### Testes

Um teste simples foi criado, para rodá-lo basta executar um dos comandos:

\$ php artisan test

\$ composer test

## Documentação das rotas da API

\$ php artisan route:list

Para visualizar a documentação completa das rotas elaborada no postman, acesse o link [Postman](https://documenter.getpostman.com/view/1636800/TVCY5rSw)

> Obs:

- Os posts e put de dados, foram feitos na tab `body`, na opção `x-www-form-urlencoded`;
- A url base usada foi a `http://127.0.0.1:8000` criada pelo comando `php artisan serve`.

| Method | URI                                      | Action                                   |
| ------ | ---------------------------------------- | ---------------------------------------- |
| POST   | /register                                | AuthController@register                  |
| POST   | /login                                   | AuthController@login                     |
| POST   | /logout                                  | AuthController@logout                    |
| GET    | /users                                   | UserController@index                     |
| GET    | /users/{id}                              | UserController@show                      |
| PUT    | /users/{id}                              | UserController@put                       |
| DELETE | /users/{id}                              | UserController@delete                    |
| GET    | /operations                              | OperationController@index                |
| GET    | account_transactions/user                | AccountTransactionController@listAccount |
| GET    | account_transactions/totalizer/{user_id} | AccountTransactionController@totalizer   |
| GET    | account_transactions/report              | AccountTransactionController@report      |
| POST   | account_transactions                     | AccountTransactionController@store       |
| DELETE | account_transactions/{id}/{user_id}      | AccountTransactionController@destroy     |
