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
use AppBundle\Entity\Analyse1;
use AppBundle\Entity\Param;
use AppBundle\Entity\Param1;
use AppBundle\Form\ParamType;
use AppBundle\Form\ParamType1;
use AppBundle\Entity\Value;
use AppBundle\Entity\Value1;
use AppBundle\Form\ValueType;
use AppBundle\Entity\Dataserie;
use AppBundle\Entity\Dataserie1;
use AppBundle\Form\DataserieType;
use Doctrine\Common\Collections\ArrayCollection;

class AnalyseController extends Controller
{

    public function indexAction(Request $request)
    {
        return $this->render('analyse/index.html.twig');
    }

    /*public function createAction(Request $request)
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
    }*/

    public function createAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();

        //Analyse form management
        $analyse = new Analyse1();
        $form = $this->createFormBuilder($analyse)
            ->setAction($this->generateUrl('analyse_create'))
            ->setMethod('POST')
            ->add('name', 'text')
            ->add('save', 'submit', array('label' => 'Create Analyse1'))
            ->getForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $analyse->setUserid($user);
            $analyse->setCreated(new \DateTime());
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

    /*public function editAction(Request $request, $analyseId)
    {
        $em = $this->getDoctrine()->getManager();
        $analyse = $em->getRepository('AppBundle:Analyse')->findOneById($analyseId);
        //$analyse->setParams(new ArrayCollection); //@TODO FOIREUX POURQUOI DOCTRINE N'INITIALISE PAS UN ARRAYCOLLECTION

        if ($request->isMethod('POST')) {
            $paramIdForm = $request->get('paramId');
            if ($paramIdForm != '' && $paramIdForm != null) {
                $paramToUpdate = $em->getRepository('AppBundle:Param')->find($paramIdForm);
                if ($paramToUpdate instanceof Param && $paramToUpdate != null) {
                    $form = $this->createForm($this->get('param_form'), $paramToUpdate);
                }else{
                    $form = $this->createForm(new ParamType(), new Param());
                }
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
                    $param = $form->getData();
                    if ($paramToUpdate == null) {
                        $em->persist($param);
                    }
                    $em->flush();
                    unset($param);
                    unset($form);
                }
            }

        }
        //$paramsList = $em->getRepository('AppBundle:Param')->findByAnalyse($analyseId);
        //@TODO FAIRE UNE COLLECTION DE FORMULAIRE
        $paramsList = $em->getRepository('AppBundle:Param')->getParamsByAnalyseId($analyseId);

        $formTab = array();
        $formTabView = array();
        $dataserie = new Dataserie();
        $dataserie->setAnalyse($analyse);

        $dataserieTest = $em->getRepository('AppBundle:Dataserie')->findOneById(1);

        for ($i=0 ; $i<count($paramsList) ; $i++){
            $param = $paramsList[$i];
            $form = $this->createForm($this->get('param_form'), $param);
            $formView = $form->createView();
            array_push($formTabView,$formView);
            array_push($formTab,$form);

            //create a dataserie with embed values
            $value = new Value();
            $value->setDataserie($dataserie->getId());
            $value->setParam($param);
            $dataserie->getValues()->add($value);

            //get params from analyse to make analyse form with embed param form
            $analyse->getParams()->add($param);
        }

        $param = new Param();
        $param->setAnalyse($analyse);

        $dataserieForm = $this->createForm($this->get('dataserie_form'), $dataserie);
        $dataserieForm->handleRequest($request);
        if ($dataserieForm->isSubmitted() && $dataserieForm->isValid()) {
            $dataserie = $dataserieForm->getData();
            $em->persist($dataserie);
            //@TODO utiliser la persistence en cascade pour les embed forms
            $values = $dataserie->getValues();
            foreach($values as $value){
                $em->persist($value);
            }
            $em->flush();
        }

        $analyseForm = $this->createForm($this->get('analyse_form'), $analyse);

        return $this->render('analyse/edit.html.twig', array(
            'analyse' => $analyse,
            'param_creation_form' => $this->createForm(new ParamType(), $param)->createView(),
            'param_creation_form_list' => $formTabView,
            'params_list' => $paramsList,
            'test_form' => $dataserieForm->createView(),
            'analyse_form' => $analyseForm->createView(),
        ));
    }*/

    public function editAction(Request $request, $analyseId)
    {
        $em = $this->getDoctrine()->getManager();
        $analyse = $em->getRepository('AppBundle:Analyse1')->findOneById($analyseId);
        //$analyse->setParams(new ArrayCollection); //@TODO FOIREUX POURQUOI DOCTRINE N'INITIALISE PAS UN ARRAYCOLLECTION

        if ($request->isMethod('POST')) {
            $paramIdForm = $request->get('paramId');
            if ($paramIdForm != '' && $paramIdForm != null) {
                $paramToUpdate = $em->getRepository('AppBundle:Param1')->find($paramIdForm);
                if ($paramToUpdate instanceof Param && $paramToUpdate != null) {
                    $form = $this->createForm($this->get('param1_form'), $paramToUpdate);
                }else{
                    $form = $this->createForm(new ParamType(), new Param());
                }
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
                    $param = $form->getData();
                    if ($paramToUpdate == null) {
                        $em->persist($param);
                    }
                    $em->flush();
                    unset($param);
                    unset($form);
                }
            }

        }
        //$paramsList = $em->getRepository('AppBundle:Param')->findByAnalyse($analyseId);
        //@TODO FAIRE UNE COLLECTION DE FORMULAIRE
        $paramsList = $em->getRepository('AppBundle:Param1')->getParamsByAnalyseId($analyseId);

        $formTab = array();
        $formTabView = array();
        $dataserie = new Dataserie1();
        $dataserie->setAnalyse1($analyse);

        $dataserieTest = $em->getRepository('AppBundle:Dataserie1')->findOneById(1);

        for ($i=0 ; $i<count($paramsList) ; $i++){
            $param = $paramsList[$i];
            $form = $this->createForm($this->get('param1_form'), $param);
            $formView = $form->createView();
            array_push($formTabView,$formView);
            array_push($formTab,$form);

            //create a dataserie with embed values
            $value = new Value1();
            $value->setDataserie1($dataserie->getId());
            $value->setParam($param);
            $dataserie->getValues()->add($value);

            //get params from analyse to make analyse form with embed param form
            $analyse->getParams()->add($param);
        }

        $param = new Param();
        $param->setAnalyse($analyse);

        $dataserieForm = $this->createForm($this->get('dataserie1_form'), $dataserie);
        $dataserieForm->handleRequest($request);
        if ($dataserieForm->isSubmitted() && $dataserieForm->isValid()) {
            $dataserie = $dataserieForm->getData();
            $em->persist($dataserie);
            //@TODO utiliser la persistence en cascade pour les embed forms
            $values = $dataserie->getValues();
            foreach($values as $value){
                $em->persist($value);
            }
            $em->flush();
        }

        $analyseForm = $this->createForm($this->get('analyse1_form'), $analyse);

        return $this->render('analyse/edit.html.twig', array(
            'analyse' => $analyse,
            'param_creation_form' => $this->createForm(new ParamType(), $param)->createView(),
            'param_creation_form_list' => $formTabView,
            'params_list' => $paramsList,
            'test_form' => $dataserieForm->createView(),
            'analyse_form' => $analyseForm->createView(),
        ));
    }

}