/**
 * Created by guillaumesoullard on 09/12/15.
 */

$(document).ready(function() {
    $('.moreParam').on('click', function() {
        $('.moreParamSection').toggle();
    });

    var data = jsonChartData;
    var chartData = $.parseJSON(jsonChartData);

    var ctx = $("#myChart").get(0).getContext("2d");
    var myRadarChart = new Chart(ctx).Radar(chartData, {
        multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"
    });




    // je veux faire mon graphique
    // 1)







    /*var dataTable = $('#param_datatable').DataTable({
        "searching": false,
        "info" : false,
        "bLengthChange": false,
        "paging" : false,
        "ordering": false,
    });

    $('.testInline, .firstCol').css('display', 'inline');

    $('#addRow').on('click', function() {
        dataTable.row.add(dataTable.rows(0).data()[0]).draw(true);
    });
    $('#param_datatable tbody').on( 'click', 'tr td:first-child ',function () {
        //dataTable.row($(this).closest('tr')).remove().draw( false );
    } );


    dataTable.getInputData = function(){
        //get the data from datatable
        var dtData = dataTable.data();
        var datatable_inputs = dataTable.$('input');
        var inputNbrByRow = dataTable.$('input').length / (dtData.length);
        //cut your inputs into row

        var indexTab = [];
        var seriesTab = [];
        var seriesTabAssociative = [];
        var temp = [];
        var tempAssociative = {};
        var temp2 = [];
        var temp2Associative = {};
        var cpt = 0;
        var relativeIndex = 0;

        for (var i=0 ; i<datatable_inputs.length ; i++){
            relativeIndex = i - cpt*inputNbrByRow;
            tempAssociative[$(datatable_inputs[i]).attr('index')] = $(datatable_inputs[i]).val();
            temp[relativeIndex] = $(datatable_inputs[i]).val();
            if (i<inputNbrByRow) {
                //indexTab[i] = $(datatable_inputs[i]).attr('index');
                indexTab[i] = $(datatable_inputs[i]).attr('paramName');
            }
            if (i%inputNbrByRow == inputNbrByRow-1) {
                temp2Associative = tempAssociative;
                temp2 = temp;
                seriesTab[cpt] = temp2;
                seriesTabAssociative[cpt] = temp2Associative;
                cpt++;
                temp = [];
                tempAssociative = {};
            }
        }

        var dtColumns = [];
        for (var i =0 ; i<indexTab.length ; i++){
            var titleObj = {};
            titleObj.title = indexTab[i];
            dtColumns.push(titleObj);
        }

        var response = {};
        response.index = indexTab;
        response.dtColumns = dtColumns;
        response.seriesData = seriesTab;
        response.seriesDataAssociative = seriesTabAssociative;
        return response;
    }

    dataTable.getParamsAttribute = function(){
        var param = {};
        var serie = [];
        var paramsCells =  $('#param_datatable thead tr td div');
        if ( paramsCells.length > 0) {
            paramsCells.each(function() {
                var paramsAttr = $(this).find('.paramAttribute');
                if (paramsAttr.length > 0){
                    paramsAttr.each(function(){
                        if ($(this).attr('index') != undefined){
                            param[$(this).attr('index')] = $(this).val();
                        }

                    });
                    serie.push(param);
                    param = {};
                }
            });
        }
        return serie;
    }

    $.verify.addRules({
        divisibleByThree: function(r) {
            var n = parseInt(r.val());
            if(n%3 !== 0){
                console.log('coucou');
                return "Not divisible by 3!"
            }

            return true;
        },
        zaza: function(r) {
            if (r.val() != 'zaza')
                return "t'es pas zaza!"
            return true;
        }
    });


    $('#chart_button').on('click', function(){

        var rawDatatableData = dataTable.getInputData();
        var paramsAttr = dataTable.getParamsAttribute();
        var calcChartValues = getChartCalcValues(paramsAttr, rawDatatableData.seriesDataAssociative);

        if ( $.fn.dataTable.isDataTable( '#example' ) ) {
            $('#example').DataTable().destroy();
        }


        var workTab = $('#example').DataTable( {
            "searching": false,
            "info" : false,
            "bLengthChange": false,
            "paging" : false,
            data: calcChartValues,
            columns: rawDatatableData.dtColumns
        } );


        //need labels and data
        var labels = rawDatatableData.index;
        labels.shift();

        var datasets = getDataChart(calcChartValues);

        var data = {
            labels: labels,
            datasets: datasets
        };
        var ctx = $("#myChart").get(0).getContext("2d");
        var myRadarChart = new Chart(ctx).Radar(data, {
            multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"
        });

        dataTable.draw(true);

    });*/





});

function transformParamAttrArray(paramsAttr)
{
    var response = [];
    for (var i=0;  i<paramsAttr.length ; i++){
        var paramId = paramsAttr[i].paramId;
        response[paramId] = paramsAttr[i];
    }
    return response;
}

function calcValueWithMinMax(value, paramAttr)
{
    var response = 0;
    var minValue = paramAttr.paramMinValue;
    var maxValue = paramAttr.paramMaxValue;

    if (minValue != '' && maxValue != ''){
        if (minValue>maxValue){
            var tmp = maxValue;
            maxValue = minValue;
            minValue = tmp;
        }
        if (!isNaN(value) && !isNaN(minValue) && !isNaN(maxValue)){
            response = ((value) / (maxValue - minValue));
        }
    } else {
        response = value;
    }
    return response;
}

function getChartCalcValues(paramsAttr, rawDatatableData)
{
    //transform ton paramsAttr array avec paramId qui fait l'index
    var paramsAttrByKeyId = transformParamAttrArray(paramsAttr);

    for (var i=0;  i<paramsAttr.length ; i++){
        var paramId = paramsAttr[i].paramId
    };

    var tab = [];
    var tmpTab = [];

    var serie = {};
    for (var i=0 ; i<rawDatatableData.length ; i++){
        serie = {};
        serie = rawDatatableData[i];
        var serieIndex = Object.keys(serie);
        for(var j=0 ; j<serieIndex.length ; j++){
            var key = serieIndex[j];
            var regex = /param_/;
            var isParam = regex.test(key);
            var value = serie[Object.keys(serie)[j]];
            tmpTab[j] = 0;
            if (isParam){
                var paramId = key.replace(regex, "");
                var paramAttr = paramsAttrByKeyId[paramId];
                var calcValue = calcValueWithMinMax(value, paramAttr);
                tmpTab[j] = calcValue;
            }else{
                tmpTab[j] = value;
            }
        }
        tab.push(tmpTab);
        tmpTab = [];
    }
    return tab;
}

function getDataChart(calcChartValues)
{
    var datasets = [];
    for (var i=0 ; i<calcChartValues.length ; i++) {
        var serieName = calcChartValues[i][0];
        var serieData = calcChartValues[i];
        serieData.shift();
        var rgbaFill = "rgba(" + Math.floor(Math.random() * 255) + "," + Math.floor(Math.random() * 255) + "," + Math.floor(Math.random() * 255) + ",0.2)";
        var rgbaStroke = "rgba(" + Math.floor(Math.random() * 255) + "," + Math.floor(Math.random() * 255) + "," + Math.floor(Math.random() * 255) + ",1)";

        var dataset = {
            label: serieName,
            fillColor: rgbaFill,
            strokeColor: rgbaStroke,
            pointColor: rgbaStroke,
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: rgbaStroke,
            data: serieData
        };
        datasets.push(dataset);
    }
    return datasets;
}

