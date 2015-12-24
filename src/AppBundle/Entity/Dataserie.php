<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Analyse
 *
 * @ORM\Table()
 * @ORM\Table(name="dataserie")
 * @ORM\Entity
 */
class Dataserie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="dataserie_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="dataserie_name", type="string", length=255)
     */
    protected $name;

    /**
     * @var \AppBundle\Entity\Analyse
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Analyse")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="analyse_id ", referencedColumnName="analyse_id")
     * })
     */
    protected $analyse;

    /*
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Value", mappedBy="dataserie", cascade={"persist"})
     * */
    protected $values;

    public function __construct()
    {
        $this->values = new ArrayCollection();
    }

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
    }

    public function setValues(ArrayCollection $values)
    {
        foreach ($values as $v){
            if (is_null($v->getDataserie())) {
                $v->setDataserie($this);
            }
        }
        $this->values = $values;
    }

    /**
     * @return Doctrine\Common\Collections\ArrayCollection;
     */
    public function getValues()
    {
        return $this->values;
    }

    public function addValue(Value $value) {
        $value->setDataserie($this);
        $this->values->add($value);
        return $this;
    }


}
