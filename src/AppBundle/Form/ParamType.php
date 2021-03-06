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

class ParamType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('POST')
            ->add('name')
            ->add('analyse', 'entity', array(
                'class' => 'AppBundle:Analyse',
                'property' => 'name',
                'label' => 'Analyse',
            ))
            ->add('minvalue', 'text', array(
                'required' => false,
            ))
            ->add('maxvalue', 'text', array(
                'required' => false
            ))
            ->add('ponderation', 'text', array(
                'required' => false
            ))
            ->add('unit', 'text', array(
                'required' => false
            ))
            ->add('type', 'entity', array(
                'class' => 'AppBundle:Typeparam',
                'property' => 'name',
                'label' => 'param'
            ));
            //->add('save', 'submit', array('label' => 'Create Parameter'));
    }

    public function getName()
    {
        return 'appbundle_paramtype';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Param'
        ));
    }
}