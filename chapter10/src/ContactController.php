<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Weekend\Service\TemplateService;

class ContactController
{
	protected $theme;

    public function __construct(TemplateService $theme)
    {
		$this->theme = $theme;
    }

	public function get()
	{
    	$content = $this->theme->render('contact.html', [
        	'title' => 'Contact'
		]);
    	return new Response($content);
	}

	public function post(Request $request)
	{
		// TODO: validate input and send email
		$content = $this->theme->render('basic.html', [
    		'title' => 'Contact',
    		'content' => "Thank you for your message.",
		]);
		return new Response($content);
	} 
}
