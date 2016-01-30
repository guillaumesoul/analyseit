<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Value1
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Value1Repository")
 */
class Value1
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
     * @ORM\Column(name="value", type="string", length=255)
     * @Groups({"chart"})
     */
    private $value;

    /**
     * @var \AppBundle\Entity\Dataserie1
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Dataserie1", inversedBy="values1")
     * @ORM\JoinColumn(name="dataserie1_id", referencedColumnName="id")
     */
    private $dataserie1;

    /**
     * @var \AppBundle\Entity\Param1
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Param1")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="param1_id ", referencedColumnName="id")
     * })
     */
    protected $param;


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
     * Set value
     *
     * @param string $value
     * @return Value
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set dataserie1
     *
     * @param \AppBundle\Entity\Dataserie1 $dataserie1
     * @return Value1
     */
    public function setDataserie1(\AppBundle\Entity\Dataserie1 $dataserie1 = null)
    {
        $this->dataserie1 = $dataserie1;

        return $this;
    }

    /**
     * Get dataserie1
     *
     * @return \AppBundle\Entity\Dataserie1 
     */
    public function getDataserie1()
    {
        return $this->dataserie1;
    }

    /**
     * Set param
     *
     * @param \AppBundle\Entity\Param1 $param
     * @return Value1
     */
    public function setParam(\AppBundle\Entity\Param1 $param = null)
    {
        $this->param = $param;

        return $this;
    }

    /**
     * Get param
     *
     * @return \AppBundle\Entity\Param1 
     */
    public function getParam()
    {
        return $this->param;
    }
}
