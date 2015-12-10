<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Created by PhpStorm.
 * User: guillaumesoullard
 * Date: 10/12/15
 * Time: 20:58
 */
class ParamRepository extends EntityRepository
{
    public function getParamsByAnalyseId($analyseId)
    {
        return $this->_em->getRepository('AppBundle:Param')->findByAnalyse($analyseId);
    }
}