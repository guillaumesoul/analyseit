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
use AppBundle\Entity\Param1;

class ParamController extends Controller
{

    /**
     * add param for an analyse
     * @param Request $request
     * @param $analyseId
     */
    public function addAction(Request $request,$analyseId)
    {
        $em = $this->getDoctrine()->getManager();
        $analyse = $em->getRepository('AppBundle:Analyse1')->findOneById($analyseId);
        $param = new Param1();
        $param->setAnalyse1($analyse);  //param1_form
        $paramForm = $this->createForm($this->get('param1_form'), $param, array(
            'action' => $this->generateUrl('analyse_addparam',array('analyseId' => $analyseId))
        ));

        if ($request->isMethod('POST')) {
            $paramForm->handleRequest($request);
            if ($paramForm->isSubmitted() && $paramForm->isValid()) {
                $param = $paramForm->getData();
                $em->persist($param);
                $em->flush();
                //unset($paramForm);
                return $this->redirect($this->generateUrl("analyse_edit", array('analyseId' => $analyseId)));
            }

        }
        return $this->render('param/add.html.twig', array(
            'param_creation_form' => $paramForm->createView(),
        ));
    }

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