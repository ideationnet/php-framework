<?php
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;

require __DIR__.'/../vendor/autoload.php';

$request = Request::createFromGlobals();

$adapter = new Local(__DIR__.'/../data');
$filesystem = new Filesystem($adapter);

$variables = json_decode($filesystem->read('menu.json'), true);

$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
$twig = new Twig_Environment($loader);

echo $twig->render('index.html', $variables['index']);
