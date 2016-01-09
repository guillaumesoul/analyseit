<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Param1
 *
 * @ORM\Table()
 * @ORM\Entity
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
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="minvalue", type="string", length=255)
     */
    private $minvalue;

    /**
     * @var string
     *
     * @ORM\Column(name="maxvalue", type="string", length=255)
     */
    private $maxvalue;

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
     * @ORM\ManyToOne(targetEntity="Analyse1", inversedBy="params1")
     * @ORM\JoinColumn(name="analyse1_id", referencedColumnName="id")
     */
    protected $analyse1;

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
     * Set minvalue
     *
     * @param string $minvalue
     * @return Param1
     */
    public function setMinvalue($minvalue)
    {
        $this->minvalue = $minvalue;

        return $this;
    }

    /**
     * Get minvalue
     *
     * @return string 
     */
    public function getMinvalue()
    {
        return $this->minvalue;
    }

    /**
     * Set maxvalue
     *
     * @param string $maxvalue
     * @return Param1
     */
    public function setMaxvalue($maxvalue)
    {
        $this->maxvalue = $maxvalue;

        return $this;
    }

    /**
     * Get maxvalue
     *
     * @return string 
     */
    public function getMaxvalue()
    {
        return $this->maxvalue;
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
}
