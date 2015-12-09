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

    public function paramformAction()
    {
        /*return $this->render(
            'param/index.html.twig',
            array('testParam' => 'testParam')
        );*/

        $param = new Param();
        $form = $this->createFormBuilder($param)
            ->add('name', 'text')
            ->add('minvalue', 'text')
            ->add('maxvalue', 'text')
            ->add('ponderation', 'text')
            ->add('unit', 'text')
            ->add('save', 'submit', array('label' => 'Create Parameter'))
            ->getForm();

        return $this->render('param/index.html.twig', array(
            'param_creation_form' => $form->createView()
        ));
    }

    public function indexAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();

        //Analyse form management
        $analyse = new Param();
        $form = $this->createFormBuilder($analyse)
            ->add('name', 'text')
            ->add('save', 'submit', array('label' => 'Create Analyze'))
            ->getForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $analyse->setUser($user);
            $em->persist($analyse);
            $em->flush();
            return $this->redirectToRoute('analyse');
        }

        $analyseService = $this->get('analyse_service');
        $analyseList = $analyseService->getUserAnlayses($user);

        return $this->render('analyse/index.html.twig', array(
            'analyse_creation_form' => $form->createView(),
            'analyse_list' => $analyseList
        ));

    }
}