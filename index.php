<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Http\Router;

define('URL', 'http://localhost/mvc');
$obRouter = new Router(URL);

require __DIR__ . '/routes/pages.php';

$obRouter->run()->sendResponse();
