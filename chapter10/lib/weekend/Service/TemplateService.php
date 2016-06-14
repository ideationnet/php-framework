<?php

namespace Weekend\Service;


use Twig_Environment;

class TemplateService
{
    protected $twig;
    protected $menu;

    public function __construct(Twig_Environment $twig, ConfigService $config)
    {
        $this->twig = $twig;
        $this->menu = $config->getConfig();
    }

    public function render($templateName, $variables)
    {
        foreach ($this->menu as $path => $menuItem)
        {
            $variables['nav'][] = [
                'title' => $menuItem['title'],
                'url' => '/' . $path,
            ];
        }
        return $this->twig->render($templateName, $variables);
    }

}
