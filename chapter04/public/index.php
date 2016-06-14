<?php
use Symfony\Component\HttpFoundation\Request;
require __DIR__.'/../vendor/autoload.php';

$request = Request::createFromGlobals();

$name = $request->get('name');

$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
$twig = new Twig_Environment($loader);

echo $twig->render('index.html', ['name' => $name]);
