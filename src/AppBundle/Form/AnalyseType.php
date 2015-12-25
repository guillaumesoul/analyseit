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

class AnalyseType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('POST')
            ->add('name', 'text')
            ->add('userid', 'entity', array(
                'class' => 'AppBundle:User',
                'property' => 'id',
                'label' => 'user',
            ))
            /*->add('created', 'date', array(
                'data' => new \DateTime()
            ))*/
            ->add('params', 'collection', array(
                'type' => new ParamType(),
                'by_reference' => false,
                'allow_add'    => true,
            ))
            ->add('save', 'submit', array('label' => 'Create Analyse'));
    }

    public function getName()
    {
        return 'appbundle_analysetype';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Analyse'
        ));
    }
}