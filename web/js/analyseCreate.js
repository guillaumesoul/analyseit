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

    //toggle display extendedParamInfo
    $scope.IsVisible = false;
    $scope.ShowHide = function () {
        $scope.IsVisible = $scope.IsVisible ? false : true;
    }

    analyse.addDataserie = function(){
        analyse.dataseries.push(new Dataserie(analyse.dataserieName,analyse.params.length));
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