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

class Value1Type extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('POST')
            ->add('dataserie1', 'entity', array(
                'class' => 'AppBundle:Dataserie1',
                'property' => 'name',
                'label' => 'dataserie',
            ))
            ->add('param', 'entity', array(
                'class' => 'AppBundle:Param1',
                'property' => 'name',
                'label' => 'param'
            ))
            ->add('value', 'text', array(
                'label' => false
            ));
    }

    public function getName()
    {
        return 'appbundle_value1type';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Value1'
        ));
    }
}