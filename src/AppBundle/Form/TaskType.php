<?php
/**
 * Created by PhpStorm.
 * User: guillaumesoullard
 * Date: 19/12/15
 * Time: 02:35
 */

namespace AppBundle\Form;
/**
 * Created by PhpStorm.
 * User: guillaumesoullard
 * Date: 10/12/15
 * Time: 10:27
 */

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Services\ParamService;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('description')
                ->add('tags', 'collection', array(
                'type' => new TagType()
            ));;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Task',
        ));
    }

    public function getName()
    {
        return "taskType";
    }


}