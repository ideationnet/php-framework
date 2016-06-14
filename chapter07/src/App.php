<?php
namespace Weekend;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Weekend\Controller\BasicPageController;
use Weekend\Controller\ContactController;

class App 
{
    public function run(Request $request)
    {
    	$path = $request->getPathInfo();
    	$method = $request->getMethod();
		switch ($path)
		{
			case '/':
			case '/index':
			case '/about':
        		$controller = new BasicPageController();
        		return $controller->get($path);
			case '/contact':
    			$controller = new ContactController();
    			if ($method == 'POST')
    			{
    				return $controller->post($request);
    			}
    			return $controller->get();
		}
		return Response::create("Not found", 404);
    }
}
