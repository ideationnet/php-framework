<?php
namespace Weekend\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;
use Weekend\Service\ConfigService;

class BasicPageController
{
	protected $menu;
	protected $twig;

	public function __construct(Twig_Environment $twig, ConfigService $config)
	{
    	$this->twig = $twig;
		$this->config = $config;
	}

	public function get($path)
	{
		$page = ($path == '/') ? 'index' : substr($path, 1);
		$menu = $this->config->getConfig();
		if (isset($menu[$page]))
		{
			$content = $this->twig->render('index.html', $menu[
			$page]);
			return new Response($content);
		}
		return Response::create("not found", 404);
	}
}
