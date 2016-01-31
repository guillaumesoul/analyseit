<?php
namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;


use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
//serialize with annotation group
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;


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

    public function toJSON($analyse)
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $normalizer = new PropertyNormalizer($classMetadataFactory);
        $serializer = new Serializer([$normalizer]);
        $analyseSerialized = $serializer->normalize($analyse, null, ['groups' => ['chart']]);
        $json = json_encode($analyseSerialized);
        return $json;
    }
}