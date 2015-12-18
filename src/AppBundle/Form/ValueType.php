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

class ValueType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('POST')
            ->add('dataserie', 'entity', array(
                'class' => 'AppBundle:Dataserie',
                'property' => 'name',
                'label' => 'dataserie',
            ))
            ->add('param', 'entity', array(
                'class' => 'AppBundle:Param',
                'property' => 'name',
                'label' => 'param'
            ))
            ->add('value');
            //->add('save', 'submit', array('label' => 'Create Parameter'));
    }

    public function getName()
    {
        return 'appbundle_valuetype';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Value'
        ));
    }
}