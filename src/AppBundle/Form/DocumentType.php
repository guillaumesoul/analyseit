<?php
/**
 * Created by PhpStorm.
 * User: guillaumesoullard
 * Date: 24/02/16
 * Time: 22:46
 */

namespace AppBundle\Form;


class DocumentType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('POST')
            ->add('name', 'text')
            ->add('save', 'submit', array('label' => 'Import'));
    }

    public function getName()
    {
        return 'appbundle_documenttype';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Document'
        ));
    }
}