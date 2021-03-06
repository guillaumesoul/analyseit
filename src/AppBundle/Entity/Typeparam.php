<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Analyse
 *
 * @ORM\Table()
 * @ORM\Table(name="typeparam")
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

    /**
     * @var boolean
     *
     * @ORM\Column(name="typeparam_discret", type="boolean")
     */
    protected $discret;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getParam1()
    {
        return $this->param1;
    }

    /**
     * @param float $param1
     */
    public function setParam1($param1)
    {
        $this->param1 = $param1;
    }

    /**
     * @return float
     */
    public function getParam2()
    {
        return $this->param2;
    }

    /**
     * @param float $param2
     */
    public function setParam2($param2)
    {
        $this->param2 = $param2;
    }

    /**
     * @return boolean
     */
    public function isSens()
    {
        return $this->sens;
    }

    /**
     * @param boolean $sens
     */
    public function setSens($sens)
    {
        $this->sens = $sens;
    }

    /**
     * @return boolean
     */
    public function isDiscret()
    {
        return $this->discret;
    }

    /**
     * @param boolean $discret
     */
    public function setDiscret($discret)
    {
        $this->discret = $discret;
    }


}
