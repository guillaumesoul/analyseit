<?php
namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use AppBundle\Classes\RadarChart;

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

class ChartService
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getRadarData($analyse)
    {
        $chart = new RadarChart();
        //get labels -> name of params
        $analyseParams = $analyse->getParams1();
        $labels = array();
        foreach($analyseParams as $param){
            array_push($labels,$param->getName());
        }
        $chart->setLabels($labels);

        //get datasets -> value of dataserie
        $analyseDataseries = $analyse->getDataseries1();
        $datasets = array();
        foreach($analyseDataseries as $dataserie){
            $tmp = array();
            $tmp['label'] = $dataserie->getName();
            $tmp['fillColor'] = "rgba(220,220,220,0.2)";
            $tmp['strokeColor'] = "rgba(220,220,220,1)";
            $tmp['pointColor'] = "rgba(220,220,220,1)";
            $tmp['pointStrokeColor'] = "#fff";
            $tmp['pointHighlightFill'] = "#fff";
            $tmp['pointHighlightStroke'] = "rgba(220,220,220,1)";

            $dataserieValues = $dataserie->getValues1();
            $tmpData = array();
            foreach($dataserieValues as $value){
                array_push($tmpData,$value->getValue());
            }
            $tmp['data'] = $tmpData;
            array_push($datasets,$tmp);
        }
        $chart->setDatasets($datasets);
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $normalizer = new PropertyNormalizer($classMetadataFactory);
        $serializer = new Serializer([$normalizer]);
        $chartData = $serializer->normalize($chart);
        $jsonChartData = json_encode($chartData);
        return $jsonChartData;
    }
}