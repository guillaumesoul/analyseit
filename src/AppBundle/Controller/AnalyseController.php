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
//use Doctrine\ORM\EntityManager;

class AnalyseController extends Controller
{

    public function indexAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();

        $analyse = new Analyse();
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
            'form' => $form->createView(),
            'analyse_list' => $analyseList,
        ));

    }
}