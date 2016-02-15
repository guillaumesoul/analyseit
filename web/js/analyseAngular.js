/**
 * Created by guillaumesoullard on 11/02/16.
 */

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
            });
        };

        $scope.removeParam = function(item) {
            var index = analyse.params.indexOf(item);
            analyse.params.splice(index, 1);
            for(indice in analyse.dataseries){
                analyse.dataseries[indice].values.splice(index, 1);
            }
            //updateView(analyse.params.length);
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



            //var val1 = analyse.dataseries[0].values[0].value;
            var val1 = new Value();
            var tezst = val1.isValidNumber();
            console.log(tezst);



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

        //$scope.myModel = 1;


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
            // maxItems: 1
        };

        //$scope.myOptions = [{value: '1', text: 'Jordy'}];
});