<?php
namespace Weekend;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class App 
{
    protected $container;
	protected $routes;

    public function __construct()
    {
        $this->container = new ContainerBuilder();
        $loader = new YamlFileLoader($this->container, new FileLocator(__DIR__));
        $loader->load('services.yml');
		$loader->load('../../src/services.yml');
    }

	public function addRoute($path, $method, $controller)
	{
		$this->routes[$path][$method] = $controller;
	}

    public function run(Request $request)
    {
    	$path = $request->getPathInfo();
    	$method = strtolower($request->getMethod());

		if (isset($this->routes[$path][$method]))
		{
			$controllerName = $this->routes[$path][$method];
			$controller =  $this->container->get($controllerName);
			return call_user_func([$controller, $method], $request);
		}
		return Response::create("Not found", 404);
    }
}
