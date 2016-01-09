<?php
namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;

class AnalyseService
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function test()
    {
        return "test";
    }
    public function getUserAnalyses($user)
    {
        //return $this->em->getRepository('AppBundle:Analyse')->findByUserid($user);
        return $this->em->getRepository('AppBundle:Analyse1')->findByUserid($user);
    }
}