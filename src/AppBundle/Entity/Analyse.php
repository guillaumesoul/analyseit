<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
    private $name;
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
     * @var integer
     *
     * @ORM\Column(name="analyse_dataserieid", type="integer")
     */
    protected $dataserieid;


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
     * Set dataserieid
     *
     * @param integer $dataserieid
     * @return Analyse
     */
    public function setDataserieid($dataserieid)
    {
        $this->dataserieid = $dataserieid;

        return $this;
    }

    /**
     * Get dataserieid
     *
     * @return integer 
     */
    public function getDataserieid()
    {
        return $this->dataserieid;
    }
}
