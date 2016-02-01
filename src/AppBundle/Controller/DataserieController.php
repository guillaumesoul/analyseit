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
use AppBundle\Entity\Dataserie1;
use AppBundle\Entity\Value1;

class DataserieController extends Controller
{

    /**
     * add param for an analyse
     * @param Request $request
     * @param $analyseId
     */
    public function listAction(Request $request,$analyseId)
    {
        $em = $this->getDoctrine()->getManager();
        $analyse = $em->getRepository('AppBundle:Analyse1')->findOneById($analyseId);

        $dataseries = $em->getRepository('AppBundle:Dataserie1')->findByAnalyse1($analyse);
        $dataseriesFormViewList = [];
        $dataseriesFormList = [];
        if(count($dataseries)>0){
            foreach($dataseries as $dataserie){
                $dataserieForm = $this->createForm($this->get('dataserie1_form'), $dataserie, array(
                    'action' => $this->generateUrl('analyse_dataserielist',array('analyseId' => $analyseId))
                ));
                $dataseriesFormList[$dataserie->getId()] = $dataserieForm;
                array_push($dataseriesFormViewList,$dataserieForm->createView());
            }
        }

        foreach($_POST as $k => $v){
            if ( preg_match('/^dataserie/',$k) ) {
                $dataserieId = $_POST[$k];
            }
        }
        if(isset($dataserieId)){
            $form = $dataseriesFormList[$dataserieId];
        }

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $dataserie = $form->getData();
                $em->persist($dataserie);
                $em->flush();
                return $this->redirect($this->generateUrl("analyse_edit", array('analyseId' => $analyseId)));
            }

        }
        return $this->render('dataserie/list.html.twig', array(
            'dataseries_form' => $dataseriesFormViewList,
        ));
    }

    /*
     * add a dataserie to the analyse
     * @param $analyseId
     * return array of dataseries_form for the analyse
     * */
    public function addAction(Request $request, $analyseId)
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

    //@todo adapt for dataserie
    //error integrity constraint violation: 1451 Cannot delete or update a parent row: a foreign key constraint fails (`datatalk`.`value1`, CONSTRAINT `FK_A2756C5A877B2D96` FOREIGN KEY (`dataserie1_id`) REFERENCES `dataserie1` (`id`))
    //pb vient pour la suppression des values -> drop cascade
    public function deleteAction(Request $request, $dataserieId)
    {
        $em = $this->getDoctrine()->getManager();
        $dataserie = $em->getRepository('AppBundle:Dataserie1')->findOneById($dataserieId);

        if (!$dataserie) {
            throw $this->createNotFoundException('No dataserie found');
        }else{
            $analyseId = $dataserie->getAnalyse1()->getId();
            $em->remove($dataserie);
            $em->flush();
            return $this->redirect($this->generateUrl('analyse_edit', array('analyseId' => $analyseId)));
        }
    }
}