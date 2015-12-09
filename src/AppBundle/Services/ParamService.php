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

    public function getUserAnlayses($user)
    {
        return $this->em->getRepository('AppBundle:Analyse')->findByUserid($user);
    }
}