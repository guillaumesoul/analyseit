<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Typeparam1
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Typeparam1Repository")
 */
class Typeparam1
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Groups({"chart"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="param1", type="string", length=255)
     * @Groups({"chart"})
     */
    private $param1;

    /**
     * @var string
     *
     * @ORM\Column(name="param2", type="string", length=255)
     * @Groups({"chart"})
     */
    private $param2;

    /**
     * @var string
     *
     * @ORM\Column(name="sens", type="string", length=255)
     * @Groups({"chart"})
     */
    private $sens;

    /**
     * @var string
     *
     * @ORM\Column(name="discret", type="string", length=255)
     * @Groups({"chart"})
     */
    private $discret;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Typeparam1
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set param1
     *
     * @param string $param1
     * @return Typeparam1
     */
    public function setParam1($param1)
    {
        $this->param1 = $param1;

        return $this;
    }

    /**
     * Get param1
     *
     * @return string 
     */
    public function getParam1()
    {
        return $this->param1;
    }

    /**
     * Set param2
     *
     * @param string $param2
     * @return Typeparam1
     */
    public function setParam2($param2)
    {
        $this->param2 = $param2;

        return $this;
    }

    /**
     * Get param2
     *
     * @return string 
     */
    public function getParam2()
    {
        return $this->param2;
    }

    /**
     * Set sens
     *
     * @param string $sens
     * @return Typeparam1
     */
    public function setSens($sens)
    {
        $this->sens = $sens;

        return $this;
    }

    /**
     * Get sens
     *
     * @return string 
     */
    public function getSens()
    {
        return $this->sens;
    }

    /**
     * Set discret
     *
     * @param string $discret
     * @return Typeparam1
     */
    public function setDiscret($discret)
    {
        $this->discret = $discret;

        return $this;
    }

    /**
     * Get discret
     *
     * @return string 
     */
    public function getDiscret()
    {
        return $this->discret;
    }
}
