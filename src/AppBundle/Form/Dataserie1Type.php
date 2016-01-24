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
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class Dataserie1Type extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('POST')
            ->add('name', 'text', array(
                'label' => false
            ))
            ->add('analyse1', 'entity', array(
                'class' => 'AppBundle:Analyse1',
                'property' => 'name',
                'label' => 'Analyse',
            ))
            ->add('values1', 'collection', array(
                'type' => new Value1Type(),
            ))
            ->add('save', 'submit', array('label' => 'Create Dataserie1'));
    }

    public function getName()
    {
        return 'appbundle_dataserie1type';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Dataserie1'
        ));
    }
}