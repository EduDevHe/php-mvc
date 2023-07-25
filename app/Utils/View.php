<?php

namespace App\Utils;

class View
{
  private array $vars;
  public static function inti($vars = [])
  {
    self::$vars = $vars;
  }

  /**
   * Método responspável por retornar o conteúdo de uma view
   *
   * @param string $view
   * @return string
   **/

  private static function getContentView(string $view): string
  {
    $file = __DIR__ . "/../../resources/view/$view.html";
    return file_exists($file) ? file_get_contents($file) : '';
  }
  /**
   * Método responspável por retornar o conteúdo rednderizado 
   * 
   * @param string 
   * @param array
   * @return string
   **/
  public static function render(string $view, array $vars = []): string
  {

    $vars = array_merge(self::$vars, $vars);
    // Obtem as chaves do array de variaveis
    $keys = array_keys($vars);

    // Monta o placeholder utilizando as chaves do array de variaveis 
    $createPlaceholder = function ($key) {
      return "{{" . $key . "}}";
    };

    // Aplica a função $createPlaceholder para cada elemento do array de variaveis
    $placeholdeKeys = array_map($createPlaceholder, $keys);

    $contentView = self::getContentView($view);

    $parseContentView = str_replace($placeholdeKeys, array_values($vars), $contentView);

    return $parseContentView;
  }
}
