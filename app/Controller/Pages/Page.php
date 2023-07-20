<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Page
{

  /**
   * 
   *
   * Método responsavel por retornar o conteúdo de uma pagina
   *
   * @param string $cotent
   * @param string $title
   * @return string
   **/
  public static function getPage(string $title, string $content): string
  {
    return View::render("pages/page", ['title' => $title, 'content' => $content]);
  }
}
