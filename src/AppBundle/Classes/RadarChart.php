<?php
/**
 * Created by PhpStorm.
 * User: guillaumesoullard
 * Date: 31/01/16
 * Time: 20:37
 */

namespace AppBundle\Classes;


class RadarChart extends Chart
{
    protected $labels;
    protected $datasets;

    public function __construct()
    {
        //parent::__construct();  //to load global config
        $this->labels = array();
        $this->datasets = array();
    }

    public function setLabels($labels)
    {
        $this->labels = $labels;
    }

    public function setDatasets($datasets)
    {
        $this->datasets = $datasets;
    }

}