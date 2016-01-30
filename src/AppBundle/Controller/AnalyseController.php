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


//serialiser
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
//serialize with annotation group
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;

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

        //new param form
        $param = new Param1();
        $param->setAnalyse1($analyse);  //param1_form
        $paramForm = $this->createForm($this->get('param1_form'), $param);

        //dataseries Form generation
        $dataseries = $em->getRepository('AppBundle:Dataserie1')->findByAnalyse1($analyse);
        $dataseriesFormViewList = [];
        $dataseriesFormList = [];
        if(count($dataseries)>0){
            foreach($dataseries as $dataserie){
                $dataserieForm = $this->createForm($this->get('dataserie1_form'), $dataserie);
                $dataseriesFormList[$dataserie->getId()] = $dataserieForm;
                array_push($dataseriesFormViewList,$dataserieForm->createView());
            }
        }

        if ($request->isMethod('POST')) {
            //determiner si requete vient de analyseForm, paramForm, dataserieForm
            $formType = $request->request->keys()[1];
            switch($formType){
                case 'appbundle_param1type':
                    $form = $paramForm;
                    break;
                case 'appbundle_analyse1type':
                    $form = $analyseForm;
                    break;
                case 'appbundle_dataserie1type':
                    //@todo améliorer cette merde dans l'ideal il faudrait que l'id soit dans le form directement
                    //get dataserieId : if dataserie form submitted, dataserieId in $_POST
                    foreach($_POST as $k => $v){
                        if ( preg_match('/^dataserie/',$k) ) {
                            $dataserieId = $_POST[$k];
                        }
                    }
                    if(isset($dataserieId)){
                        $form = $dataseriesFormList[$dataserieId];
                    }
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

        //TEST ENVOI PHP OBJECT EN JSON POUR OBTENTION DATA DANS JAVASCRIPT
        //ce qui serait formidable serait de json encode mon analyse pour alimenter un objet javascript
        //probleme de reference circulaire avec mon modèle analyse->param->analyse

        $normalizer = new ObjectNormalizer();
        $typeParam = new Typeparam();
        $typeParam->setName('bépo');
        $typeParam->setParam1(12);
        $typeParam->setParam2(22);
        $result = $normalizer->normalize($typeParam);
        $eiu = json_encode($result);

        //$entity = new Analyse1();
        //$obj->setId($analyse->getId());
        //$entity->setName($analyse->getName());
        //$entity->setCreated($analyse->getCreated());
        //$result = $normalizer->normalize($obj); //Cannot normalize attribute "params1" because injected serializer is not a normalizer
        //$eiu = json_encode($obj);    //empty
        $serializer = new Serializer(array(new GetSetMethodNormalizer()), array('json' => new
        JsonEncoder()));
        //$json = $serializer->serialize($entity, 'json');  //circular reference problem with a fully defined analyse

        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $normalizer = new PropertyNormalizer($classMetadataFactory);
        $serializer = new Serializer([$normalizer]);

        $fds = $em->getRepository('AppBundle:Analyse1')->findOneById($analyseId);
        $eiu = $serializer->normalize($fds, null, ['groups' => ['chart']]);
        $json = json_encode($eiu);




        $za ='zzad';



        return $this->render('analyse/edit.html.twig', array(
            'analyse' => $analyse,
            'param_creation_form' => $paramForm->createView(),
            'analyse_form' => $analyseForm->createView(),
            'dataseries_form' => $dataseriesFormViewList,
            'test' => $json,
            //'test' => $jsonContent,
        ));
    }

    /*
     * add a dataserie to the analyse
     *
     * @param $analyseId
     * return array of dataseries_form for the analyse
     * */
    public function adddataserieAction(Request $request, $analyseId)
    {
        $em = $this->getDoctrine()->getManager();
        $analyse = $em->getRepository('AppBundle:Analyse1')->findOneById($analyseId);

        $dataserie = new Dataserie1();
        $dataserie->setAnalyse1($analyse);
        $dataserie->setName('new serie');

        $analyseParams = $analyse->getParams1();
        foreach($analyseParams as $param){
            $value = new Value1();
            $value->setDataserie1($dataserie);
            $value->setParam($param);
            $dataserie->addValues1($value);
        }
        $em->persist($dataserie);
        $em->flush();
        return $this->redirect($this->generateUrl("analyse_edit", array('analyseId' => $analyseId)));
    }

}