<?php
namespace AppBundle\Form;

/**
 * Created by PhpStorm.
 * User: guillaumesoullard
 * Date: 10/12/15
 * Time: 10:27
 */

use Doctrine\DBAL\Types\ArrayType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Test2Type extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('POST')
            ->add('name', 'text')
            /*->add('test1', 'collection', array(
                'type' => new Test1Type(),
                'by_reference' => false,
                'allow_add'    => true,
            ))*/
            ->add('test1', 'entity', array(
                'class' => 'AppBundle:Test2',
                'property' => 'id',
                'label' => 'test1',
            ))
            ->add('save', 'submit', array('label' => 'Create test2'));
    }

    public function getName()
    {
        return 'appbundle_test1type';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Test2'
        ));
    }
}