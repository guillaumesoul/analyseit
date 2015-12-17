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

    public function editAction(Request $request, $analyseId)
    {
        $em = $this->getDoctrine()->getManager();
        $analyse = $em->getRepository('AppBundle:Analyse')->findOneById($analyseId);

        //PARAM CREATION FORM HANDLING
        $param = new Param();
        $paramType = new ParamType();
        $form = $this->createForm($paramType, $param);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $param = $form->getData();
            $param->setAnalyse($analyse);
            //$em->persist($param);
            //$em->flush();
            unset($param);
            unset($form);
            $param = new Param();
            $form = $this->createForm(new ParamType(), $param);
        }

        //PARAM LIST FOR SELECTED ANALYSE
        //$paramsList = $em->getRepository('AppBundle:Param')->findByAnalyse($analyseId);
        $paramsList = $em->getRepository('AppBundle:Param')->getParamsByAnalyseId($analyseId);
        $formTab = array();
        $formTabView = array();
        for ($i=0 ; $i<count($paramsList) ; $i++){
            $param = $paramsList[$i];
            $paramId = $param->getId();
            $newParam = $em->getRepository('AppBundle:Param')->findById($paramId);

            //$form = $this->createForm($paramType, $param);
            $form = $this->createForm($this->get('param_form'), $param);
            $formView = $form->createView();
            array_push($formTabView,$formView);
            array_push($formTab,$form);
        }
        if ($request->isMethod('POST')) {
            $paramIdForm = $request->get('paramId');
            $paramToUpdate = $test = $em->getRepository('AppBundle:Param')->find($paramIdForm);
            $formTest = $this->createForm($this->get('param_form'), $paramToUpdate);
            $formTest->handleRequest($request);
            if ($formTest->isSubmitted() && $formTest->isValid()) {
                $zaz = 'ezae';
                $param = $formTest->getData();
                //$param->setAnalyse($analyse);
                //$em->persist($param);
                $em->flush();
            }
        }



        /*for ($i=0 ; $i<count($formTab) ; $i++){
            $formIndex = $formTab[$i];
            $formIndex->handleRequest($request);
            if ($formIndex->isSubmitted() && $formIndex->isValid() && false) {
                $param = $formIndex->getData();
                $test = $em->getRepository('AppBundle:Param')->find($param);
                $param->setAnalyse($analyse);
                //$em->persist($param);
                //$em->flush();
            }
        }*/


        return $this->render('analyse/edit.html.twig', array(
            'analyse' => $analyse,
            'param_creation_form' => $form->createView(),
            'param_creation_form_list' => $formTabView,
            'params_list' => $paramsList
        ));
    }

}