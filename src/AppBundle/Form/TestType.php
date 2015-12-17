<?php
namespace AppBundle\Form;

/**
 * Created by PhpStorm.
 * User: guillaumesoullard
 * Date: 10/12/15
 * Time: 10:27
 */

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Services\ParamService;

class TestType extends AbstractType
{
    /*private $myService;

    public function __construct(ParamService $myService)
    {
        $this->myService = $myService;
    }*/

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('POST')
            ->add('name', 'text')
            ->add('minvalue', 'text')
            ->add('maxvalue', 'text')
            ->add('save', 'submit', array('label' => 'Create value'));
    }

    public function getName()
    {
        return 'appbundle_testtype';
    }


}