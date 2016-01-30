<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

//serialization
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Analyse1
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Analyse1
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
     * @Groups({"chart"})
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetimetz")
     */
    private $created;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id ", referencedColumnName="id")
     * })
     */
    private $userid;

    /**
     * @ORM\OneToMany(targetEntity="Param1", mappedBy="analyse1")
     * @Groups({"chart"})
     */
    private $params1;

    /**
     * @ORM\OneToMany(targetEntity="Dataserie1", mappedBy="analyse1")
     */
    private $dataseries1;

    public function __construct()
    {
        $this->params1 = new ArrayCollection();
        $this->dataseries1 = new ArrayCollection();
    }

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
     * @return Analyse1
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
     * Set created
     *
     * @param \DateTime $created
     * @return Analyse1
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set userid
     *
     * @param \AppBundle\Entity\User $userid
     * @return Analyse1
     */
    public function setUserid(\AppBundle\Entity\User $userid = null)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get userid
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Add params1
     *
     * @param \AppBundle\Entity\Param1 $params1
     * @return Analyse1
     */
    public function addParams1(\AppBundle\Entity\Param1 $params1)
    {
        $this->params1[] = $params1;

        return $this;
    }

    /**
     * Remove params1
     *
     * @param \AppBundle\Entity\Param1 $params1
     */
    public function removeParams1(\AppBundle\Entity\Param1 $params1)
    {
        $this->params1->removeElement($params1);
    }

    /**
     * Get params1
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getParams1()
    {
        return $this->params1;
    }

    /**
     * Add dataseries1
     *
     * @param \AppBundle\Entity\Dataserie1 $dataseries1
     * @return Analyse1
     */
    public function addDataseries1(\AppBundle\Entity\Dataserie1 $dataseries1)
    {
        $this->dataseries1[] = $dataseries1;

        return $this;
    }

    /**
     * Remove dataseries1
     *
     * @param \AppBundle\Entity\Dataserie1 $dataseries1
     */
    public function removeDataseries1(\AppBundle\Entity\Dataserie1 $dataseries1)
    {
        $this->dataseries1->removeElement($dataseries1);
    }

    /**
     * Get dataseries1
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDataseries1()
    {
        return $this->dataseries1;
    }
}
