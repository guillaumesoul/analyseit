<?php
/**
 * Created by PhpStorm.
 * User: guillaumesoullard
 * Date: 09/09/15
 * Time: 22:36
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpFoundation\JsonResponse;

class HelloController extends Controller
{
    public function indexAction()
    {
        $this->addFlash(
            'notice',
            'Your changes were saved!'
        );

        //return $this->render('AppBundle:zaza:index.html.twig', array('name' => "guillaume"));

        $html = $this->container->get('templating')->render('hello/index.html.twig');
        return new Response($html);

    }
}