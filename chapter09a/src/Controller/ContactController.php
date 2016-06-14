<?php
namespace Weekend\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;
use Twig_Loader_Filesystem;

class ContactController
{
	protected $twig;

    public function __construct(Twig_Environment $twig)
    {
		$this->twig = $twig;
    }

	public function get()
	{
    	$content = $this->twig->render('contact.html', [
        	'title' => 'Contact'
		]);
    	return new Response($content);
	}

	public function post(Request $request)
	{
		// TODO: validate input and send email
		$content = $this->twig->render('basic.html', [
    		'title' => 'Contact',
    		'content' => "Thank you for your message.",
		]);
		return new Response($content);
	} 
}
