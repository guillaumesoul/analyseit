<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Analyse
 *
 * @ORM\Table()
 * @ORM\Table(name="analyse")
 * @ORM\Entity
 */
class Analyse
{
    /**
     * @var integer
     *
     * @ORM\Column(name="analyse_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="analyse_name", type="string", length=255)
     */
    protected $name;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id ", referencedColumnName="id")
     * })
     */
    protected $userid;

    /**
     * @ORM\Column(name="analyse_created", type="datetime")
     */
    protected $created;

    /**
     * @ORM\OneToMany(targetEntity="Param", mappedBy="analyse", cascade={"persist"})
     */
    protected $params;

    public function __construct()
    {
        $this->params = new ArrayCollection();
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
     * @return Analyse
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
     * Set userid
     *
     * @param AppBundle\Entity\User
     * @return Analyse
     */
    public function setUser($user)
    {
        $this->userid = $user;

        return $this;
    }

    /**
     * Get userid
     *
     * @return integer
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Analyse
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
     * @return Analyse
     */
    public function setUserid(\AppBundle\Entity\User $userid = null)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Add 	params
     *
     * @param \AppBundle\Entity\Param $params
     * @return Analyse
     */
    public function addParams(\AppBundle\Entity\Param $params)
    {
        $this->	params[] = $params;

        return $this;
    }

    /**
     * Remove 	params
     *
     * @param \AppBundle\Entity\Param $params
     */
    public function removeParams(\AppBundle\Entity\Param $params)
    {
        $this->params->removeElement($params);
    }

    /**
     * Get 	params
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Add params
     *
     * @param \AppBundle\Entity\Param $params
     * @return Analyse
     */
    public function addParam(\AppBundle\Entity\Param $params)
    {
        $this->params[] = $params;

        return $this;
    }

    /**
     * Remove params
     *
     * @param \AppBundle\Entity\Param $params
     */
    public function removeParam(\AppBundle\Entity\Param $params)
    {
        $this->params->removeElement($params);
    }
}
