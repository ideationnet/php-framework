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

    public function __construct()
    {
        $this->container = new ContainerBuilder();
        $loader = new YamlFileLoader($this->container, new FileLocator(__DIR__));
        $loader->load('services.yml');
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
				$controller = $this->container->get('basic_page_controller');
				return $controller->get($path);
			case '/contact':
				$controller = $this->container->get('contact_controller');
				if ($method == 'POST')
				{
					return $controller->post($request);
				}
				return $controller->get();
		}
		return Response::create("Not found", 404);
    }
}
