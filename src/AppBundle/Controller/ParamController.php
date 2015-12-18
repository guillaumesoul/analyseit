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
use AppBundle\Entity\Param;

class ParamController extends Controller
{

    public function deleteAction(Request $request, $paramId)
    {
        $em = $this->getDoctrine()->getManager();
        $param = $em->getRepository('AppBundle:Param')->findOneById($paramId);

        if (!$param) {
            throw $this->createNotFoundException('No param found');
        }else{
            $analyseId = $param->getAnalyse()->getId();
            $em->remove($param);
            $em->flush();
            return $this->redirect($this->generateUrl('analyse_edit', array('analyseId' => $analyseId)));
        }
    }
}