<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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


}
