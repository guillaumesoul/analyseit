<?php
/**
 * Created by PhpStorm.
 * User: guillaumesoullard
 * Date: 28/11/15
 * Time: 12:38
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Analyse;

class AnalyseController extends Controller
{
    public function indexAction()
    {
        $form = $this->createFormBuilder()
            ->setMethod('post')
            ->setAction('')
            ->add('name', 'text')
            ->add('save', 'submit', array('label' => 'Create Analyze'))
            ->getForm();

        return $this->render('create/index.html.twig', array(
            'form' => $form->createView(),
        ));

    }

    public function createAction()
    {
        $analyse = new Analyse();

    }
}