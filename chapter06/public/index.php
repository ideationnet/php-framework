<?php
use Symfony\Component\HttpFoundation\Request;

require __DIR__.'/../vendor/autoload.php';

$request = Request::createFromGlobals();

$app = new \Weekend\App();
$response = $app->run($request);
$response->send();
