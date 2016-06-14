<?php
use Symfony\Component\HttpFoundation\Request;

require __DIR__.'/../vendor/autoload.php';

$request = Request::createFromGlobals();

$app = new \Weekend\App();
$app->addRoute('/', 'get', 'basic_page_controller');
$app->addRoute('/index', 'get', 'basic_page_controller');
$app->addRoute('/about', 'get', 'basic_page_controller');
$app->addRoute('/contact', 'get', 'contact_controller');
$response = $app->run($request);
$response->send();
