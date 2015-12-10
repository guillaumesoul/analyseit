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
use AppBundle\Entity\Analyse;
use AppBundle\Entity\Param;
use AppBundle\Form\ParamForm;
use AppBundle\Form\ParamType;

class AnalyseController extends Controller
{

    public function indexAction(Request $request)
    {
        return $this->render('analyse/index.html.twig');

    }

    public function createAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();

        //Analyse form management
        $analyse = new Analyse();
        $form = $this->createFormBuilder($analyse)
            ->setAction($this->generateUrl('analyse_create'))
            ->setMethod('POST')
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

        return $this->render('analyse/create.html.twig', array(
            'analyse_creation_form' => $form->createView(),
        ));
    }

    public function getUserAnalysesListAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();

        $analyseService = $this->get('analyse_service');
        $analyseList = $analyseService->getUserAnalyses($user);

        return $this->render('analyse/list.html.twig', array(
            'analyse_list' => $analyseList
        ));
    }

    //public function editAction($analyseId)
    public function editAction(Request $request, $analyseId)
    //public function editAction()
    {

        $param = new Param();
        $form = $this->createForm(new ParamType(), $param);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // do whatever you want ...
            $param = $form->getData(); // to get submitted data

            $em = $this->getDoctrine()->getManager();
            $analyse = $em->getRepository('AppBundle:Analyse')->findOneById($analyseId);
            $param->setAnalyse($analyse);

            $em->persist($param);
            $em->flush();
            // redirect, show twig, your choice
        }

        return $this->render('analyse/edit.html.twig', array(
            'param_creation_form' => $form->createView()
        ));


        /*$paramService = $this->get('param_service');
        $paramTypeList = $paramService->getAllTypeparam();
        $paramform = new ParamForm();
        $paramformAction = $this->generateUrl('param_create');
        $formParam = $this->createForm($paramform, array(
            'analyseId' => $analyseId,
            'action' => $paramformAction,
            'paramTypeList' => $paramTypeList,
        ));

        //il me faut la liste actuelle de tous les param pour cette analyse


        return $this->render('analyse/edit.html.twig', array(
            'analyseId' => $analyseId,
            'param_creation_form' => $formParam->createView()
        ));*/
    }

}