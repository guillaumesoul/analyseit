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

class AnalyseController extends Controller
{

    public function indexAction(Request $request)
    {
        $analyse = new Analyse();

        $form = $this->createFormBuilder($analyse)
            ->add('name', 'text')
            ->add('save', 'submit', array('label' => 'Create Analyze'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($analyse);
            $em->flush();
            return $this->redirectToRoute('analyse');
        }

        return $this->render('create/index.html.twig', array(
            'form' => $form->createView(),
        ));

    }
}