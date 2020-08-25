<?php

namespace App\Helpers;

use App\Constants\AppConstants;

class Helper
{
  /**
   * headerCsv
   *
   * @param string $file_name
   * @return array
   */
  public static function headerCsv($file_name = 'file')
  {
    return [
      "Content-type" => "text/csv",
      "Content-Disposition" => "attachment; filename=${file_name}.csv",
      "Pragma" => "no-cache",
      "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
      "Expires" => "0"
    ];
  }

  /**
   * mountCsv
   * Recebe os dados e monta o arquivo CSV
   *
   * @param [type] $data
   * @param array $columns
   * @param [type] $header
   * @return void
   */
  public static function mountCsv($data, array $columns, $header = null)
  {
    return function () use ($data, $columns, $header) {
      $file = fopen('php://output', 'w');
      if ($header) {
        fputcsv($file, [$header], AppConstants::CSV_DELIMITER);
      }
      fputcsv($file, $columns, AppConstants::CSV_DELIMITER);

      foreach ($data as $row) {
        $rows = array();
        foreach ($columns as $c) {
          $rows[] = $row->$c;
        }
        fputcsv(
          $file,
          $rows,
          AppConstants::CSV_DELIMITER
        );
      }
      fclose($file);
    };
  }

  /**
   * urlRememberKey
   * Retorna um valor que será usada como chave do cache
   *
   * @return void
   */
  public static function urlRememberKey()
  {
    $url = request()->url();
    $query_params = request()->query();

    ksort($query_params); // ordena os itens do array
    $query_string = http_build_query($query_params);

    return sha1("{$url}?{$query_string}");
  }
}
