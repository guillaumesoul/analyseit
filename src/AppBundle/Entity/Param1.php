<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

//serialization
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Param1
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Param1Repository")
 */
class Param1
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
     * @ORM\Column(name="min", type="string", length=255)
     */
    private $min;

    /**
     * @var string
     *
     * @ORM\Column(name="max", type="string", length=255)
     */
    private $max;

    /**
     * @var string
     *
     * @ORM\Column(name="ponderation", type="string", length=255)
     */
    private $ponderation;

    /**
     * @var string
     *
     * @ORM\Column(name="unit", type="string", length=255)
     */
    private $unit;

    /**
     * @var \AppBundle\Entity\Analyse1
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Analyse1", inversedBy="params1")
     * @ORM\JoinColumn(name="analyse1_id", referencedColumnName="id")
     */
    private $analyse1;

    /**
     * @var \AppBundle\Entity\Typeparam1
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Typeparam1")
     * @ORM\JoinColumn(name="typeparam1_id", referencedColumnName="id")
     */
    private $type;

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
     * @return Param1
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
     * Set min
     *
     * @param string $min
     * @return Param1
     */
    public function setMin($min)
    {
        $this->min = $min;

        return $this;
    }

    /**
     * Get min
     *
     * @return string 
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * Set max
     *
     * @param string $max
     * @return Param1
     */
    public function setMax($max)
    {
        $this->max = $max;

        return $this;
    }

    /**
     * Get max
     *
     * @return string 
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * Set ponderation
     *
     * @param string $ponderation
     * @return Param1
     */
    public function setPonderation($ponderation)
    {
        $this->ponderation = $ponderation;

        return $this;
    }

    /**
     * Get ponderation
     *
     * @return string 
     */
    public function getPonderation()
    {
        return $this->ponderation;
    }

    /**
     * Set unit
     *
     * @param string $unit
     * @return Param1
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return string 
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set analyse1
     *
     * @param \AppBundle\Entity\Analyse1 $analyse1
     * @return Param1
     */
    public function setAnalyse1(\AppBundle\Entity\Analyse1 $analyse1 = null)
    {
        $this->analyse1 = $analyse1;

        return $this;
    }

    /**
     * Get analyse1
     *
     * @return \AppBundle\Entity\Analyse1 
     */
    public function getAnalyse1()
    {
        return $this->analyse1;
    }

    /**
     * Set type
     *
     * @param \AppBundle\Entity\Typeparam1 $type
     * @return Param1
     */
    public function setType(\AppBundle\Entity\Typeparam1 $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\Typeparam1 
     */
    public function getType()
    {
        return $this->type;
    }
}
