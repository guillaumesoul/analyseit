<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Analyse
 *
 * @ORM\Table()
 * @ORM\Table(name="typeparamww")
 * @ORM\Entity
 */
class Typeparam
{
    /**
     * @var integer
     *
     * @ORM\Column(name="typeparam_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="typeparam_name", type="string", length=255)
     */
    protected $name;

    /**
     * @var float
     *
     * @ORM\Column(name="typeparam_param1", type="float")
     */
    protected $param1;

    /**
     * @var float
     *
     * @ORM\Column(name="typeparam_param2", type="float")
     */
    protected $param2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="typeparam_sens", type="boolean")
     */
    protected $sens;
}
