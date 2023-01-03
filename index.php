<?php
require __DIR__ . '/vendor/autoload.php';

use Bramus\Router\Router;

/*
Router
*/
$router = new Router();
// $router->get('aduh', 'GetToken.php');
$router->get('', '\App\Controllers\Controllers@helloWorld');
$router->post('token', '\app\GetToken.php');
$router->post('mail/send', '\App\Controllers\MailController@send');
?>