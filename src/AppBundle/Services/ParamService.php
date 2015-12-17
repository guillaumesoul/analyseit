<?php
    namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;

class ParamService
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getAllTypeparam()
    {
        return $this->em->getRepository('AppBundle:Typeparam')->findAll();
    }
}