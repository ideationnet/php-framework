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
    	$form = $this->twig->render('forms/contact.html');
    	$content = $this->twig->render('index.html', [
        	'title' => 'Contact',
        	'content' => $form,
		]);
    	return new Response($content);
	}

	public function post(Request $request)
	{
		// TODO: validate input and send email
		$content = $this->twig->render('index.html', [
    		'title' => 'Contact',
    		'content' => "Thank you for your message.",
		]);
		return new Response($content);
	} 
}
