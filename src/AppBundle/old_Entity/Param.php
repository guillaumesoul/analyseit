<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Param
 *
 * @ORM\Table(name="param", indexes={@ORM\Index(name="analyse_id", columns={"analyse_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ParamRepository")
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
     *
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
     * @var \AppBundle\Entity\Typeparam
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Typeparam")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="typeparam_id", referencedColumnName="typeparam_id")
     * })
     */
    protected $type;

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
     * @ORM\Column(name="param_unit", type="string", length=50)
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
     * Get analyse
     *
     * @return Analyse
     */
    public function getAnalyse()
    {
        return $this->analyse;
    }

    /**
     * @param Analyse $analyse
     */
    public function setAnalyse($analyse)
    {
        $this->analyse = $analyse;

        return $this;
    }

    /**
     * @return Typeparam
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param Typeparam $type
     */
    public function setType($type)
    {
        $this->type = $type;
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
