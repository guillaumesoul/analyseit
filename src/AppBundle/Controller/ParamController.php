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
use AppBundle\Entity\Param;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ParamController extends Controller
{

    public function paramformAction(Request $request)
    {

        $param = new Param();

        //get all the type of param
        $paramService = $this->get('param_service');
        //$paramtypeList = $paramService->getAllTypeparam();

        $formTest = $this->createFormBuilder()
            ->add('isAttending', 'choice', array(
                'choices'  => array(
                    'Maybe' => null,
                    'Yes' => true,
                    'No' => false,
                ),
                // *this line is important*
                'choices_as_values' => true,
            ))
            ->add('typeparam', 'entity', array(
                'class' => 'AppBundle:Typeparam',
                'property' => 'name',
                'label' => 'name',
                'choices' => $paramService->getAllTypeparam(),
            ))
            ->getForm();

        $form = $this->createFormBuilder($param)
            ->add('name', 'text')
            ->add('minvalue', 'text')
            ->add('maxvalue', 'text')
            ->add('ponderation', 'text')
            //->add('type', 'text')
            ->add('type', 'entity', array(
                'class' => 'AppBundle:Typeparam',
                'property' => 'name',
                'label' => 'name',
                'choices' => $paramService->getAllTypeparam(),
            ))
            ->add('unit', 'text')
            ->add('save', 'submit', array('label' => 'Create Parameter'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            //$em = $this->getDoctrine()->getManager();
            //$em->persist($param);
            //$em->flush();
            $new_param = $param;
            $erza = 'fds';
        }
        return $this->render('param/index.html.twig', array(
            'param_creation_form' => $form->createView(),
            'test_form' => $formTest->createView(),
        ));
    }

    /*public function indexAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();

        //Analyse form management
        $analyse = new Param();
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
            'analyse_creation_form' => $form->createView(),
            'analyse_list' => $analyseList
        ));

    }*/
}