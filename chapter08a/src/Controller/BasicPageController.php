<?php
namespace Weekend\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;
use Twig_Loader_Filesystem;

class BasicPageController
{
	protected $menu;
	protected $twig;

	public function __construct(Twig_Environment $twig, $menu)
	{
    	$this->twig = $twig;
    	$this->menu = $menu;
	}

	public function get($path)
	{
		$page = ($path == '/') ? 'index' : substr($path, 1);
		if (isset($this->menu[$page]))
		{
			$content = $this->twig->render('index.html', $this->menu[$page]);
			return new Response($content);
		}
		return Response::create("not found", 404);
	}
}
