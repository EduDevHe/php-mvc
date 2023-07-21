<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Page
{

  /**
   * Metodo responsavel por retornar uma View do Header 
   *
   *
   * @return string
   **/
  private static function getHeader()
  {
    return View::render('pages/header');
  }

  /**
   * Metodo responsavel por retornar uma View do Header 
   *
   *
   * @return string
   **/
  private static function getFooter()
  {
    return View::render('pages/footer');
  }
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
    return View::render("pages/page", ['title' => $title, 'header' => self::getHeader(), 'content' => $content, 'footer' => self::getFooter()]);
  }
}
