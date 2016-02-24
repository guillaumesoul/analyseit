<?php
/**
 * Created by PhpStorm.
 * User: guillaumesoullard
 * Date: 28/11/15
 * Time: 12:38
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Document;
use AppBundle\Entity\Typeparam;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Analyse;
use AppBundle\Entity\Analyse1;
use AppBundle\Entity\Param;
use AppBundle\Entity\Param1;
use AppBundle\Form\ParamType;
use AppBundle\Form\Param1Type;
use AppBundle\Entity\Value;
use AppBundle\Entity\Value1;
use AppBundle\Form\ValueType;
use AppBundle\Entity\Dataserie;
use AppBundle\Entity\Dataserie1;
use AppBundle\Form\DataserieType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Stopwatch\Stopwatch;

class AnalyseController extends Controller
{

    public function indexAction(Request $request)
    {
        return $this->render('analyse/index.html.twig');
    }

    //CREATE WITH FORM
    /*public function createAction(Request $request)
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
            $dataserie = new Dataserie1();
            $dataserie->setAnalyse1($analyse);
            $dataserie->setName('serie 1');
            $em->persist($dataserie);
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
        $document = new Document();
        $uploadForm = $this->createFormBuilder($document)
            ->add('name')
            ->add('file')
            ->getForm();

        return $this->render('analyse/create2.html.twig',array(
            'upload_form' => $uploadForm->createView()
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
        $analyse = $em->getRepository('AppBundle:Analyse1')->findOneById($analyseId);
        $analyseForm = $this->createForm($this->get('analyse1_form'), $analyse);

        if ($request->isMethod('POST')) {
            //determiner si requete vient de analyseForm, paramForm, dataserieForm
            //@todo trouver une maniere plus elegante de recupere l'id du form
            $formType = $request->request->keys()[0];
            switch($formType){
                case 'appbundle_analyse1type':
                    $form = $analyseForm;
                    break;
            }
            if(isset($form)){
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
                    $object = $form->getData();
                    if($request->request->keys()[0] == 'appbundle_param1type')  $em->persist($object);
                    $em->flush();
                    unset($object);
                    unset($form);
                }
            }

        }
        //$analyseService = $this->get('analyse_service');
        //$json = $analyseService->toJSON($analyse);

        $chartService = $this->get('chart_service');
        $jsonChartData = $chartService->getRadarData($analyse);

        return $this->render('analyse/edit.html.twig', array(
            'analyse' => $analyse,
            'analyse_form' => $analyseForm->createView(),
            'jsonChartData' => $jsonChartData,
        ));
    }

    public function uploadAction()
    {
        $data = array();

        if(isset($_GET['files']))
        {
            $error = false;
            $files = array();

            $uploaddir = './uploads/';
            foreach($_FILES as $file)
            {
                if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name'])))
                {
                    $files[] = $uploaddir .$file['name'];
                }
                else
                {
                    $error = true;
                }
            }
            $data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
        }
        else
        {
            $data = array('success' => 'Form was submitted', 'formData' => $_POST);
        }

        return $this->redirect($this->generateUrl('analyse_create'));
    }



}