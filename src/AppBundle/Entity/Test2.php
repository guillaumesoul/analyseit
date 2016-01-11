<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Test2
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Test2
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
     * @var \AppBundle\Entity\Test1
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Test1", inversedBy="tests2")
     * @ORM\JoinColumn(name="test1_id", referencedColumnName="id")
     */
    private $test1;


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
     * @return Test2
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
     * Set test1
     *
     * @param \AppBundle\Entity\Test1 $test1
     * @return Test2
     */
    public function setTest1(\AppBundle\Entity\Test1 $test1 = null)
    {
        $this->test1 = $test1;

        return $this;
    }

    /**
     * Get test1
     *
     * @return \AppBundle\Entity\Test1 
     */
    public function getTest1()
    {
        return $this->test1;
    }
}