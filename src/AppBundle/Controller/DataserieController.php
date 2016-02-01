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