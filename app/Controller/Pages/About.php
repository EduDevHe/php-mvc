<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class About extends Page
{
  public static function getAbout()
  {
    $content = View::render("pages/About", [
      "name" => "EduDevHe",
      "description" => "Developer"
    ]);
    return parent::getPage("About", $content);
  }
}
