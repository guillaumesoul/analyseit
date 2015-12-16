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
            $em->remove($param);
            $em->flush();
            return $this->redirect($this->generateUrl('analyse_edit', array('analyseId' => $param->getAnalyse()->getId())));
        }
    }

    public function saveAction(Request $request, $paramId)
    {
        $em = $this->getDoctrine()->getManager();
        $param = $em->getRepository('AppBundle:Param')->findOneById($paramId);

        if (!$param) {
            throw $this->createNotFoundException('No param found');
        }else{
            //update param data...

            $em->persist($param);
            $em->flush();
            return $this->redirect($this->generateUrl('analyse_edit', array('analyseId' => $param->getAnalyse()->getId())));
        }
    }
}