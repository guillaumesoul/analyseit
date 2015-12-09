<?php
/**
 * Created by PhpStorm.
 * User: guillaumesoullard
 * Date: 28/11/15
 * Time: 12:38
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DatatableController extends Controller
{

    public function indexAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();

        $analyseService = $this->get('analyse_service');
        $analyseList = $analyseService->getUserAnalyses($user);

        return $this->render('datatable/index.html.twig', array(
            'param1' => 'value1',
            'param2' => 'value2'
        ));
    }

    public function testAction($new_param = null, $youhou = null)
    {
        //get your param var
        $param = $new_param;
        $ds = 'sda';

        return $this->render('datatable/index.html.twig', array(
            'test' => 'test'
        ));
    }
}