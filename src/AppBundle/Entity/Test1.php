<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Test1
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Test1
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
     * @var \AppBundle\Entity\Test2
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Test2" , mappedBy="test1")
     * @ORM\JoinColumn(name="test2_id", referencedColumnName="id")
     */
    private $tests2;


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
     * @return Test1
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
        $this->tests2 = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add tests2
     *
     * @param \AppBundle\Entity\Test2 $tests2
     * @return Test1
     */
    public function addTests2(\AppBundle\Entity\Test2 $tests2)
    {
        $this->tests2[] = $tests2;

        return $this;
    }

    /**
     * Remove tests2
     *
     * @param \AppBundle\Entity\Test2 $tests2
     */
    public function removeTests2(\AppBundle\Entity\Test2 $tests2)
    {
        $this->tests2->removeElement($tests2);
    }

    /**
     * Get tests2
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTests2()
    {
        return $this->tests2;
    }
}
