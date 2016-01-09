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

    /*
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Param", mappedBy="analyse", cascade={"persist"})
     * */
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
     * @return Doctrine\Common\Collections\ArrayCollection;
     */
    public function getParams()
    {
        return $this->params;
    }

    public function setParams(ArrayCollection $params)
    {
        foreach ($params as $param){
            if (is_null($param->getAnalyse())) {
                $param->setAnalyse($this);
            }
        }
        $this->params = $params;
    }

    public function addParam(Param $param)
    {
        $param->setAnalyse($this);
        $this->params->add($param);
        return $this;
    }
}