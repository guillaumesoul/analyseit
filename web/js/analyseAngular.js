/**
 * Created by guillaumesoullard on 11/02/16.
 */

typeParamArray = {
    1: 'Number',
    2: 'Text',
    3: 'Date',
    4: 'Time',
    5: 'Localization',
    6: 'Money',
};

analyseInit = initAnalyse(3);
bindInputValidation();

angular.module('datatalkApp', ['selectize'])
    .controller('AnalyseController', function($scope) {
        var analyse = this;
        analyse.params = analyseInit.paramList;
        analyse.dataseries = analyseInit.dataseries;

        $scope.analyse.addParam = function() {
            analyse.params.push(new Param(analyse.paramName));
            analyse.paramName = '';
            for(index in analyse.dataseries){  //update dataserie
                analyse.dataseries[index].values.push(new Value());
            }
            setTimeout(function() {
                updateView(analyse.params.length);
                bindInputValidation();
            });
        };

        $scope.removeParam = function(item) {
            var index = analyse.params.indexOf(item);
            analyse.params.splice(index, 1);
            for(indice in analyse.dataseries){
                analyse.dataseries[indice].values.splice(index, 1);
            }
            updateView(analyse.params.length);
        }

        $scope.removeDataserie = function(item) {
            var index = analyse.dataseries.indexOf(item);
            analyse.dataseries.splice(index, 1);
        }

        analyse.addDataserie = function(){
            analyse.dataseries.push(new Dataserie(analyse.dataserieName,analyse.params.length));
            setTimeout(function() {
                bindInputValidation();
            });
        }

        //toggle display extendedParamInfo
        $scope.IsVisible = false;
        $scope.ShowHide = function () {
            $scope.IsVisible = $scope.IsVisible ? false : true;
        }

        analyse.Reset = function () {
            analyse.params = initAnalyse(3).paramList;
            analyse.dataseries = initAnalyse(3).dataseries;
        }

        //Display chart on Chart button click
        analyse.Chart = function () {
            $('#chart').html('<canvas id="myChart" width="400" height="400"></canvas>'); //to destroy previous chart
            var labels = [];
            var allParamsInfo = [];
            for(indiceParam in analyse.params){
                //chart labels
                labels.push(analyse.params[indiceParam].name);
                //get parameters info
                //@todo verify validity for each entries
                var paramInfo = {
                    indice: indiceParam,
                    name: analyse.params[indiceParam].name,
                    minVal: analyse.params[indiceParam].minVal,
                    maxVal: analyse.params[indiceParam].maxVal,
                    ponderation: analyse.params[indiceParam].ponderation,
                    unit: analyse.params[indiceParam].unit,
                    type: analyse.params[indiceParam].type,
                };
                allParamsInfo.push(paramInfo);
            }

            var chartDatasets = [];
            for(indiceDataserie in analyse.dataseries){
                //get value for dataserie
                datasetValues = [];
                for(indiceValue in analyse.dataseries[indiceDataserie].values){
                    if(!isNaN(parseFloat(analyse.dataseries[indiceDataserie].values[indiceValue].value))){
                        datasetValues.push(parseFloat(analyse.dataseries[indiceDataserie].values[indiceValue].value));
                    }
                }
                //calculate with parameter minValue maxValue
                var processeDatasetValues = processDatasetsWithParamData(allParamsInfo,datasetValues);

                //generate Chart dataset
                var dataserieColor = generateNewColor();
                chartDataset = {
                    label: analyse.dataseries[indiceDataserie].name,
                    fillColor: "rgba("+dataserieColor+",0.2)",
                    strokeColor: "rgba("+dataserieColor+",1)",
                    pointColor: "rgba("+dataserieColor+",1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba("+dataserieColor+",1)",
                    data: processeDatasetValues
                };
                chartDatasets.push(chartDataset);
            }
            //send json to dom
            var ctx = document.getElementById("myChart").getContext("2d");
            var radarChart = new Chart(ctx).Radar({
                labels: labels,
                datasets: chartDatasets
            });
        }


        /* SELECTIZE DATA */
        $scope.typeparamLabelOptions = [
            {id: 1, title: 'Param Type'}
        ];

        $scope.typeparamOptions = [
            {id: 1, title: 'Number'},
            {id: 2, title: 'Text'},
            {id: 3, title: 'Date'},
            {id: 4, title: 'Time'},
            {id: 5, title: 'Localization'},
            {id: 6, title: 'Money'}
        ];

        $scope.myConfig = {
            create: true,
            valueField: 'id',
            labelField: 'title',
            delimiter: '|',
            placeholder: 'Type',
            maxItems: 1,
            onInitialize: function(selectize){
                selectize.setValue(1);  //init selectize with number type
            },
        };
});


//fonction permettant d'ajuster la width de id="panelAnalyseEdition" en fonction du nombre de param
function updateView(nbParam)
{
    ($('.paramInfo li').width()*nbParam < window.screen.width) ? $('#panelAnalyseEdition').width(window.screen.width) : $('#panelAnalyseEdition').width($('.paramInfo li').width()*nbParam+100);
}

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


// détection a la volee de la validite de la saisi en fonction du type de parametre sélectionné
// un bon format est defini par le type de parametre en haut de la colonne
function bindInputValidation()
{
    $('.dataserieValue, .paramMinValue, .paramMaxValue, .paramPonderation').bind('input', function() {
        var objectValue = new Value();
        objectValue.value = $(this).val();
        //get type param in text : 'Number', 'Text' etc...
        var typeParamText = typeParamArray[$(".paramData[paramIndex='" + $(this).attr('dataserieIndex') + "'] .typeParam").val()];
        var validationTest = objectValue.isValid(typeParamText);
        if(validationTest != true){
            $(this).notify(validationTest,{autoHideDelay: 750});
            $(this).addClass('alert-danger');
        }else{
            if($(this).hasClass('alert-danger')) $(this).removeClass('alert-danger');
        }
    });
}