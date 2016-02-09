/**
 * Created by guillaumesoullard on 07/02/16.
 */

var analyseInit = initAnalyse(3);

angular.module('datatalkApp', []).controller('AnalyseController', function($scope) {
    var analyse = this;
    analyse.params = analyseInit.paramList;
    analyse.dataseries = analyseInit.dataseries;

    analyse.addParam = function() {
        analyse.params.push(new Param(analyse.paramName));
        analyse.paramName = '';
        for(index in analyse.dataseries){  //update dataserie
            analyse.dataseries[index].values.push(new Value());
        }
        adjustAnalysePanelWidth(analyse.params.length);
    };

    $scope.removeParam = function(item) {
        var index = analyse.params.indexOf(item);
        analyse.params.splice(index, 1);
        for(indice in analyse.dataseries){
            analyse.dataseries[indice].values.splice(index, 1);
        }
        adjustAnalysePanelWidth(analyse.params.length);
    }

    $scope.removeDataserie = function(item) {
        var index = analyse.dataseries.indexOf(item);
        analyse.dataseries.splice(index, 1);
    }

    analyse.addDataserie = function(){
        analyse.dataseries.push(new Dataserie(analyse.dataserieName,analyse.params.length));
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
        //TOUTES MES INFO DES PARAMETRE DANS LE TABLEAU CI DESSOUS
        console.log(allParamsInfo);


        var datasets = [];
        var dataset = {};
        var datasetData = [];
        for(indiceDataserie in analyse.dataseries){
            //get value for dataserie
            datasetData = [];
            for(indiceValue in analyse.dataseries[indiceDataserie].values){

                if(!isNaN(parseFloat(analyse.dataseries[indiceDataserie].values[indiceValue].value))){

                    //recuperation de la valeur sans calcul de la cellule
                    datasetData.push(parseFloat(analyse.dataseries[indiceDataserie].values[indiceValue].value));


                    
                }

            }

            var dataserieColor = generateNewColor();
            dataset = {
                label: analyse.dataseries[indiceDataserie].name,
                fillColor: "rgba("+dataserieColor+",0.2)",
                strokeColor: "rgba("+dataserieColor+",1)",
                pointColor: "rgba("+dataserieColor+",1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba("+dataserieColor+",1)",
                data: datasetData
            };
            datasets.push(dataset);
        }
        //send json to dom
        var ctx = document.getElementById("myChart").getContext("2d");
        var radarChart = new Chart(ctx).Radar({
            labels: labels,
            datasets: datasets
        });
    }

});
//fonction permettant d'ajuster la width de id="panelAnalyseEdition" en fonction du nombre de param
function adjustAnalysePanelWidth(nbParam)
{
    ($('.paramInfo li').width()*nbParam < window.screen.width) ? $('#panelAnalyseEdition').width(window.screen.width) : $('#panelAnalyseEdition').width($('.paramInfo li').width()*nbParam+100);
}

/* CONSTRUCTEUR */
function Analyse () {
    this.name = 'nouvelle analyse';
    this.description = 'description';
    this.paramList = {};
    this.dataserie = {};
}
function Param (name) {
    this.name = name;
    this.minVal = '';
    this.maxVal = '';
    this.ponderation = '';
    this.unit = '';
    this.type = '';
}
function Dataserie (name, nbvalues) {
    this.name = name;
    this.values = [];
    if(nbvalues === parseInt(nbvalues, 10)){
        for(var i=0; i<nbvalues; i++){
            var newValue = new Value();
            this.values.push(newValue);
        }
    }

}
function Value () {
    this.dataserie = '';
    this.param = '';
    this.value = Math.floor((Math.random() * 100) + 1);;
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

//generate a new color for chart dataserie
//"rgba(220,220,220,0.2)"
/*
@param float 0<opacity<1
 */
function generateNewColor()
{
    var randR = Math.floor((Math.random() * 255) + 1);
    var randG = Math.floor((Math.random() * 255) + 1);
    var randB = Math.floor((Math.random() * 255) + 1);
    var color = randR+","+randG+","+randB;
    return color;

}