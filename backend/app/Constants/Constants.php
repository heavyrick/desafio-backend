<?php

namespace App\Constants;

class AppConstants
{
  // Mensagens de validação dos campos
  const FORMV_MESSAGE_BOOLEAN = 'Valor deve ser 0 ou 1';
  const FORMV_MESSAGE_DATE_FORMAT = 'O formato da data não é válido';
  const FORMV_MESSAGE_AGE_INVALID = 'A idade do usuário deve maior que 18 anos para ser cadastrado';
  const FORMV_MESSAGE_EMAIL_INVALID = 'O e-mail não é válido';
  const FORMV_MESSAGE_REQUIRED = 'O campo - :attribute - é obrigatório';
  const FORMV_MESSAGE_NUMERIC = 'O valor de - :attribute - deve ser numérico';

  // Mensagens de retorno dos controladores da API
  const API_REGISTER_SUCCESS = 'Usuário registrado com sucesso!';
  const API_LOGIN_SUCCESS = 'Usuário logado com sucesso!';
  const API_LOGIN_ERROR = 'Falha no login, verifique as credenciais digitadas';
  const API_LOGOUT_SUCCESS = 'Usuário deslogado com sucesso!';
  const API_UNAUTHENTICATED_ERROR = 'Usuário não autenticado ou token inválido. Faça o login.';
  const API_POST_SUCCESS = 'Registro criado com sucesso!';
  const API_PUT_SUCCESS = 'Registro atualizado com sucesso!';
  const API_DELETE_SUCCESS = 'Registro excluído com sucesso!';
  const API_GET_ERROR_NOTFOUND = 'Registro não encontrado';
  const API_DELETE_ERROR = 'Registro não excluído, verifique os dados informados.';
  const API_DELETE_ERROR_CHECK_ACCOUNT = 'Registro não excluído, o usuário possui saldo ou movimentações no sistema.';

  // Formatos padrão de data e hora a serem retornados pelo banco de dados
  const FORMAT_DATETIME_PTBR = "%d/%m/%Y %H:%i:%s"; // Ex: 20/08/2020 15:30:02
  const FORMAT_DATE_PTBR = "%d/%m/%Y";
  const FORMAT_TIME_PTBR = "%H:%i:%s";

  // CSV options
  const CSV_DELIMITER = ';';
}
