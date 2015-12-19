<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Analyse
 *
 * @ORM\Table()
 * @ORM\Table(name="value")
 * @ORM\Entity
 */
class Value
{
    /**
     * @var integer
     *
     * @ORM\Column(name="value_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \AppBundle\Entity\Dataserie
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Dataserie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dataserie_id ", referencedColumnName="dataserie_id")
     * })
     */
    protected $dataserie;

    /**
     * @var \AppBundle\Entity\Param
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Param")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="param_id ", referencedColumnName="param_id")
     * })
     */
    protected $param;

    /**
     * @var string
     *
     * @ORM\Column(name="value_value", type="string", length=20)
     */
    protected $value;

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
     * @return Dataserie
     */
    public function getDataserie()
    {
        return $this->dataserie;
    }

    /**
     * @param Dataserie $dataserie
     */
    public function setDataserie($dataserie)
    {
        $this->dataserie = $dataserie;
    }

    /**
     * @return Param
     */
    public function getParam()
    {
        return $this->param;
    }

    /**
     * @param Param $param
     */
    public function setParam($param)
    {
        $this->param = $param;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }


}
