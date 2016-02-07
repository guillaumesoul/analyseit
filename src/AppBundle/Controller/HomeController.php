<?php
/**
 * Created by PhpStorm.
 * User: guillaumesoullard
 * Date: 20/11/15
 * Time: 18:52
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    public function indexAction()
    {
        $html = $this->container->get('templating')->render('home/index.html.twig');
        return new Response($html);

    }
}