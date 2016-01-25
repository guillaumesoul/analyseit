<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dataserie1
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Dataserie1Repository")
 */
class Dataserie1
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
     * @var \AppBundle\Entity\Analyse1
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Analyse1", inversedBy="dataseries1")
     * @ORM\JoinColumn(name="analyse1_id", referencedColumnName="id")
     */
    private $analyse1;

    /**
     * @ORM\OneToMany(targetEntity="Value1", mappedBy="dataserie1",cascade={"persist"})
     */
    private $values1;


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
     * @return Dataserie1
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
     * Constructor
     */
    public function __construct()
    {
        $this->values = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set analyse1
     *
     * @param \AppBundle\Entity\Analyse1 $analyse1
     * @return Dataserie1
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
     * Add values1
     *
     * @param \AppBundle\Entity\Value1 $values1
     * @return Dataserie1
     */
    public function addValues1(\AppBundle\Entity\Value1 $values1)
    {
        $this->values1[] = $values1;

        return $this;
    }

    /**
     * Remove values1
     *
     * @param \AppBundle\Entity\Value1 $values1
     */
    public function removeValues1(\AppBundle\Entity\Value1 $values1)
    {
        $this->values1->removeElement($values1);
    }

    /**
     * Get values1
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getValues1()
    {
        return $this->values1;
    }
}
