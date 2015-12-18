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

class DataserieType extends AbstractType
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
            ));
    }

    public function getName()
    {
        return 'appbundle_dataserietype';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Dataserie'
        ));
    }
}