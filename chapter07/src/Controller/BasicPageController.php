<?php
namespace Weekend\Controller;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;
use Twig_Loader_Filesystem;

class BasicPageController
{
	protected $filesystem;
	protected $menu;
	protected $twig;

	public function __construct()
	{
		$adapter = new Local(__DIR__.'/../../data');
		$this->filesystem = new Filesystem($adapter);

		$this->menu = json_decode($this->filesystem->read('menu.json'), true);
		
		$loader = new Twig_Loader_Filesystem(__DIR__.'/../../templates');
		$this->twig = new Twig_Environment($loader);
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
