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
        $t1 = microtime(TRUE);
        $mem = memory_get_usage();

        $perf = array(
            'memory' => (memory_get_usage() - $mem) / (1024 * 1024),
            'seconds' => microtime(TRUE) - $t1
        );

        $html = $this->container->get('templating')->render('home/index.html.twig');
        return new Response($html);

    }
}