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

    /*public function paramformAction(Request $request)
    {

        $param = new Param();
        $paramService = $this->get('param_service');

        $form = $this->createFormBuilder($param)
            ->setAction($this->generateUrl('paramform'))
            ->setMethod('POST')
            ->add('name', 'text')
            ->add('minvalue', 'text')
            ->add('maxvalue', 'text')
            ->add('ponderation', 'text')
            ->add('type', 'entity', array(
                'class' => 'AppBundle:Typeparam',
                'property' => 'name',
                'label' => 'type',
                'choices' => $paramService->getAllTypeparam(),
            ))
            ->add('unit', 'text')
            ->add('save', 'submit', array('label' => 'Create Parameter'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            //add parameter to parameter list;
            //OU JE STOCKE MA LISTE DE PARAMETRES??? COMMENT JE LA CONSULTE? DEPUIS OU?

            //update datatable;
            //redirect to analyse

            return $this->redirectToRoute('analyse');
            //return $this->forward('AppBundle:Datatable:test',array('new_param' => $param));

        }
        return $this->render('param/index.html.twig', array(
            'param_creation_form' => $form->createView()
        ));
    }*/

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
}