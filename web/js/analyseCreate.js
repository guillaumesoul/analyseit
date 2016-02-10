/**
 * Created by guillaumesoullard on 07/02/16.
 */


var analyseInit = initAnalyse(3);

$(document).ready(function(){
    
});

/*
* creation des differents object js pour le nbParam specifies
* @param int nbParam : nombre de parametres avec lequel initalisé le tableau
* */
function initAnalyse(nbParam)
{
    var analyse = new Analyse();
    var params = [];
    var dataseries = [];
    if(nbParam === parseInt(nbParam, 10)){
        var dataserie = new Dataserie('new dataset',nbParam);
        dataseries.push(dataserie);
        for(var i= 1; i<=parseInt(nbParam) ; i++){
            var newParam = new Param('param'+i);
            params.push(newParam);
        }
    }
    analyse.paramList = params;
    analyse.dataseries= dataseries;
    analyse.name= 'new analyse';
    analyse.description= 'description';
    return analyse;
}

function processDatasetsWithParamData(allParamsInfo,datasetData)
{
    var valueInit = 0;
    var minVal = 0;
    var maxVal = 0;
    var processedValue = 0;
    var processedDatasetValues = [];
    //@todo set best min val regarding range through all dataseries
    for(var j=0 ; j<datasetData.length ; j++){
        valueInit = datasetData[j];
        (allParamsInfo[j].minVal == '') ?   minVal = 0 : minVal = parseFloat(allParamsInfo[j].minVal);
        (allParamsInfo[j].maxVal == '') ?   maxVal = 100 : maxVal = parseFloat(allParamsInfo[j].maxVal);
        processedValue = (valueInit-minVal)/(maxVal-minVal)*100;
        processedDatasetValues[j] = processedValue;
    }
    return processedDatasetValues;
}

//generate a new RGB color for chart dataserie in output format = "R,G,B"
function generateNewColor()
{
    var randR = Math.floor((Math.random() * 255) + 1);
    var randG = Math.floor((Math.random() * 255) + 1);
    var randB = Math.floor((Math.random() * 255) + 1);
    var color = randR+","+randG+","+randB;
    return color;

}

//je veux faire la validation de mes inputs

//2 solution : verify notify et angular
//1 - architecture faire des objects de type value auxquels on va appliquer des prototype de méthodes
// ex : Value.isValidNumber();
//du coup faire des objets héritant de classe value : ValueNumber, ValueString, ValueDate, ValueChoiceList, ValueTime




// je veux vérifier à la volée si la value saisie est de bon format
// un bon format est defini par le type de parametre en haut de la colonne