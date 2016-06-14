<?php
namespace Weekend;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;
use Twig_Loader_Filesystem;
use Weekend\Controller\BasicPageController;
use Weekend\Controller\ContactController;

class App 
{
    protected $twig;
    protected $filesystem;

    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
        $this->twig = new Twig_Environment($loader);
        $adapter = new Local(__DIR__.'/../data');
        $this->filesystem = new Filesystem($adapter);
    }

    private function getMenuConfig()
    {
        return json_decode($this->filesystem->read('menu.json'), true);
    }

    public function run(Request $request)
    {
    	$path = $request->getPathInfo();
    	$method = $request->getMethod();
		switch ($path)
		{
			case '/':
			case '/index':
			case '/about':
                $menu = $this->getMenuConfig();
        		$controller = new BasicPageController($this->twig, $menu);
        		return $controller->get($path);
			case '/contact':
    			$controller = new ContactController($this->twig);
    			if ($method == 'POST')
    			{
    				return $controller->post($request);
    			}
    			return $controller->get();
		}
		return Response::create("Not found", 404);
    }
}
