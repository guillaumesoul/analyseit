<?php
namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;

class DataserieService
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
}