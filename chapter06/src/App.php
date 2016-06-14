<?php
namespace Weekend;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;
use Twig_Loader_Filesystem;

class App 
{
    public function run(Request $request)
    {
    	$path = $request->getPathInfo();
    	
        $adapter = new Local(__DIR__.'/../data');
		$filesystem = new Filesystem($adapter);

		$variables = json_decode($filesystem->read('menu.json'), true);
		
		$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
		$twig = new Twig_Environment($loader);
		
		$content = '';
		switch ($path)
		{
			case '/':
			case '/index':
			    $content = $twig->render('index.html', $variables['index']);
			    break;
			case '/about':
			    $content = $twig->render('index.html', $variables['about']);
			        break;
		}

		if (empty($content))
		{
    		return Response::create("Not found", 404);
		}
		return Response::create($content);
    }
}
