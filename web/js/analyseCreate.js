/**
 * Created by guillaumesoullard on 07/02/16.
 */

var analyseInit = initAnalyse(5);

angular.module('datatalkApp', []).controller('AnalyseController', function($scope) {
    var analyse = this;
    analyse.params = analyseInit.paramList;
    analyse.dataseries = analyseInit.dataseries;

    analyse.addParam = function() {
        analyse.params.push(new Param(analyse.paramName));
        analyse.paramName = '';
        //update dataserie
        for(index in analyse.dataseries){
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
        analyse.params = initAnalyse(5).paramList;
        analyse.dataseries = initAnalyse(5).dataseries;
    }

    analyse.Chart = function () {
        var labels = [];
        for(indiceParam in analyse.params){
            labels.push(analyse.params[indiceParam].name);
        }
        console.log(labels);

        var datasets = [];
        var dataset = {};
        var datasetData = [];
        for(indiceDataserie in analyse.dataseries){
            dataset = {
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
            };
            dataset.label = analyse.dataseries[indiceDataserie].name;
            dataset.data = analyse.dataseries[indiceDataserie].values;
            for(indiceValue in analyse.dataseries[indiceDataserie].values){
                datasetData = [];
                console.log(analyse.dataseries[indiceDataserie].values[indiceValue].value);
                datasetData.push(analyse.dataseries[indiceDataserie].values[indiceValue].value);
            }
            console.log(datasetData);
            datasets.push(dataset);
        }
        var data2 = {};
        data2.labels = labels;
        data2.datasets = datasets;

        /*console.log(data);

        var ctx = document.getElementById("myChart").getContext("2d");
        console.log(ctx);
        new Chart(ctx).Radar(data);*/

        var data = {
            //labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
            labels: data2.labels,
            datasets: data2.datasets
        };

        console.log(data);
        console.log(data2);

        var ctx = document.getElementById("myChart").getContext("2d");
        //var myRadarChart = new Chart(ctx).Radar(data);
    }

});

//je veux recuperer mes donnes de mes differentes dataserie
//quel format json pour intialiser le graphe chart.js

//get labels
/*$('.fa-bar-chart').on('click', function(){
    console.log('graph ! ');

    //get labels
    var labels = [];
    console.log(analyse);

    var data = {
        labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [65, 59, 90, 81, 56, 55, 40]
            },
            {
                label: "My Second dataset",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [28, 48, 40, 19, 96, 27, 100]
            }
        ]
    };

    var ctx = document.getElementById("myChart").getContext("2d");
    var myRadarChart = new Chart(ctx).Radar(data);
});*/




/*var data = {
    labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
    datasets: [
        {
            label: "My First dataset",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: [65, 59, 90, 81, 56, 55, 40]
        },
        {
            label: "My Second dataset",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [28, 48, 40, 19, 96, 27, 100]
        }
    ]
};*/


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
    this.value = '0';
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