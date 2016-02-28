<?php
namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;

//for excel bundle
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

class ExcelService
{
    protected $em;
    protected $phpexcel;

    public function __construct(EntityManager $em, $phpexcel)
    {
        $this->em = $em;
        $this->phpexcel = $phpexcel;
    }

    /* read excel file
    je veux faire un objet avec des lignes et des colonnes
    @param AppBundle\Entity\Document $document
    @return
    */
    public function readExcelFile($document)
    {
        //on va lire notre excel pour le remplir notre datatalk
        //$docPath = $document->getWebPath();
        //$docPath2 = $document->getAbsolutePath();
        //$phpExcelObject = $this->get('phpexcel')->createPHPExcelObject($document->getWebPath());

        $phpExcelObject = $this->phpexcel->createPHPExcelObject('uploads/documents/test.xlsx');

        $excelSheet = array();


        foreach ($phpExcelObject->getWorksheetIterator() as $worksheet) {
            //echo 'Worksheet - ' , $worksheet->getTitle() , EOL;
            foreach ($worksheet->getRowIterator() as $row) {
                $tmpRow = array();
                //echo '    Row number - ' , $row->getRowIndex() , EOL;
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
                foreach ($cellIterator as $cell) {
                    //array_push($tmpRow,$cell->getValue());
                    //$santized = filter_var($cell->getValue(),FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    //$santized = htmlentities($cell->getValue());
                    //array_push($tmpRow,$santized);
                    if (!is_null($cell)) {
                        $cellValue = $cell->getValue();
                        //preg_replace('"','\"',$cellValue);
                        array_push($tmpRow,$cell->getValue());
                    }
                }
            array_push($excelSheet,$tmpRow);
            }
        }
        return $excelSheet;
    }
}