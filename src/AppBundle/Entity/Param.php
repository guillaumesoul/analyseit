<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Param
 *
 * @ORM\Table()
 * @ORM\Table(name="param", indexes={@ORM\Index(name="analyse_id", columns={"analyse_id"})})
 * @ORM\Entity
 */

class Param
{
    /**
     * @var integer
     *
     * @ORM\Column(name="param_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="param_name", type="string", length=30)
     */
    protected $name;

    /**
     * @var \AppBundle\Entity\Analyse
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Analyse")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="analyse_id", referencedColumnName="analyse_id")
     * })
     */
    protected $analyse;


    /**
     * @var integer
     *
     * @ORM\Column(name="param_typeid", type="integer")
     */
    protected $typeid;

    /**
     * @var string
     *
     * @ORM\Column(name="param_minvalue", type="string", length=20)
     */
    protected $minvalue;

    /**
     * @var string
     *
     * @ORM\Column(name="param_maxvalue", type="string", length=20)
     */
    protected $maxvalue;

    /**
     * @var string
     *
     * @ORM\Column(name="param_ponderation", type="string", length=20)
     */
    protected $ponderation;

    /**
     * @var string
     *
     * @ORM\Column(name="param_unit", type="string", length=20)
     */
    protected $unit;


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
     * @return Param
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
     * Set analyse
     *
     * @param integer $analyse
     * @return Param
     */
    public function setAnalyse($analyse)
    {
        $this->analyse = $analyse;

        return $this;
    }

    /**
     * Get analyse
     *
     * @return Analyse
     */
    public function getAnalyse()
    {
        return $this->analyse;
    }

    /**
     * Set typeid
     *
     * @param integer $typeid
     * @return Param
     */
    public function setTypeid($typeid)
    {
        $this->typeid = $typeid;

        return $this;
    }

    /**
     * Get typeid
     *
     * @return integer 
     */
    public function getTypeid()
    {
        return $this->typeid;
    }

    /**
     * Set minvalue
     *
     * @param string $minvalue
     * @return Param
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
     * @return Param
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
     * @return Param
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
     * @return Param
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
}
