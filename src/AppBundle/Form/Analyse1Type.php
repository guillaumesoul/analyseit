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

class Analyse1Type extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('POST')
            ->add('name', 'text')
            /*->add('userid', 'entity', array(
                'class' => 'AppBundle:User',
                'property' => 'id',
                'label' => 'user',
            ))*/
            ->add('created', 'date', array(
                'data' => new \DateTime()
            ))
            ->add('params1', 'collection', array(
                'type' => new Param1Type(),
                'by_reference' => false,
                'allow_add'    => true,
            ))
            ->add('save', 'submit', array('label' => 'Create Analyse1'));
    }

    public function getName()
    {
        return 'appbundle_analyse1type';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Analyse1'
        ));
    }
}