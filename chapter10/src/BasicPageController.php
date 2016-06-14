<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Weekend\Service\ConfigService;
use Weekend\Service\TemplateService;

class BasicPageController
{
	protected $menu;
	protected $theme;

	public function __construct(TemplateService $theme, ConfigService $config)
	{
    	$this->theme = $theme;
		$this->config = $config;
	}

	public function get(Request $request)
	{
		$path = $request->getPathInfo();
		$page = ($path == '/') ? 'index' : substr($path, 1);
		$menu = $this->config->getConfig();
		if (isset($menu[$page]))
		{
			$content = $this->theme->render('basic.html', $menu[$page]);
			return new Response($content);
		}
		return Response::create("not found", 404);
	}
}
