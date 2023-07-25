<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Http\Response;
use \App\Http\Router;
use \App\Controller\Pages\Home;

define('URL', 'http://localhost/mvc');
$test = new Router(URL);
$test->get('/', [
  function () {
    return new Response(200, Home::getHome());
  }
]);

$test->run()->sendResponse();
