<?php
/**
 * Created by PhpStorm.
 * User: guillaumesoullard
 * Date: 28/11/15
 * Time: 12:38
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Test1;
use AppBundle\Entity\Test2;
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

    public function editAction(Request $request, $analyseId)
    {
        $em = $this->getDoctrine()->getManager();
        $analyse = $em->getRepository('AppBundle:Analyse1')->findOneById($analyseId);
        $analyseForm = $this->createForm($this->get('analyse1_form'), $analyse);
        $param = new Param1();
        $param->setAnalyse1($analyse);  //param1_form
        $paramForm = $this->createForm($this->get('param1_form'), $param);

        if ($request->isMethod('POST')) {
            //determiner si requete vient de form param ou analyse
            $formType = $request->request->keys()[0];
            switch($formType){
                case 'appbundle_param1type':
                    $form = $paramForm;
                    break;
                case 'appbundle_analyse1type':
                    $form = $analyseForm;
                    break;
            }
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $object = $form->getData();
                if($request->request->keys()[0] == 'appbundle_param1type'){
                    //@todo persist($object) doesn't work pb with type
                    $newParam = new Param1();
                    $newParam->setName($object->getName());
                    $newParam->setMin($object->getMin());
                    $newParam->setMax($object->getMax());
                    $newParam->setPonderation($object->getPonderation());
                    $newParam->setUnit($object->getUnit());
                    $typeparam = $object->getType();
                    $newParam->setType($typeparam);
                    $em->persist($newParam);
                }

                $em->flush();
                unset($object);
                unset($typeparam);
                unset($form);
            }

        }

        return $this->render('analyse/edit.html.twig', array(
            'analyse' => $analyse,
            'param_creation_form' => $paramForm->createView(),
            'analyse_form' => $analyseForm->createView(),
        ));
    }

}