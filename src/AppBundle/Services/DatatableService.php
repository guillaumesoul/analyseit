<?php
namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;

class DatatableService
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /*
     *
     * */
    public function getAnalyseDataTableData($analyseId)
    {
        $datatableData = '';
        $analyse = $this->em->getRepository('AppBundle:Analyse')->findOneById($analyseId);
        $paramsList = $this->em->getRepository('AppBundle:Param')->findByAnalyse($analyse);




        return $datatableData;
    }
}