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
use Symfony\Component\OptionsResolver\OptionsResolver;

class Param1Type extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('POST')
            ->add('name')
            ->add('analyse1', 'entity', array(
                'class' => 'AppBundle:Analyse1',
                'property' => 'name',
                'label' => 'Analyse',
            ))
            ->add('min', 'text', array(
                'required' => false,
            ))
            ->add('max', 'text', array(
                'required' => false
            ))
            ->add('ponderation', 'text', array(
                'required' => false
            ))
            ->add('unit', 'text', array(
                'required' => false
            ))
            ->add('type', 'entity', array(
                'class' => 'AppBundle:Typeparam1',
                'property' => 'name',
                'label' => 'param'
            ))
            ->add('save', 'submit', array('label' => 'Create Parameter1'));
    }

    public function getName()
    {
        return 'appbundle_param1type';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Param1'
        ));
    }
}