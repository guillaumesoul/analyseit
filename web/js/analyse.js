/**
 * Created by guillaumesoullard on 09/12/15.
 */


$(document).ready(function() {

    var dataTable = $('#param_datatable').DataTable({
        "searching": false,
        "info" : false,
        "bLengthChange": false,
        "paging" : false
    });

    $('#addRow').on('click', function() {
        dataTable.row.add(dataTable.rows(0).data()[0]).draw(true);
    });
    $('#param_datatable tbody').on( 'click', 'tr td:first-child ',function () {
        dataTable.row($(this).closest('tr')).remove().draw( false );
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
                indexTab[i] = $(datatable_inputs[i]).attr('index');
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
                        param[$(this).attr('index')] = $(this).val();
                    });
                    serie.push(param);
                    param = {};
                }
            });
        }
        return serie;
    }



    $('#chart_button').on('click', function(){

        var rawDatatableData = dataTable.getInputData();
        var paramsAttr = dataTable.getParamsAttribute();
        var calcChartValues = getChartCalcValues(paramsAttr, rawDatatableData.seriesDataAssociative);


        if ( $.fn.dataTable.isDataTable( '#example' ) ) {
            $('#example').DataTable().destroy();
        }

        console.log(calcChartValues);
        console.log(rawDatatableData.seriesData);
        var workTab = $('#example').DataTable( {
            "searching": false,
            "info" : false,
            "bLengthChange": false,
            "paging" : false,
            //data: rawDatatableData.seriesData,
            data: calcChartValues,
            columns: rawDatatableData.dtColumns
        } );

    });

    //CHART
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


    //var ctx = $("#myChart").get(0).getContext("2d");
    //var myRadarChart = new Chart(ctx).Radar(data);


});

function getParamAttribute(paramId,paramsAttr)
{
    var response = 'response';
    for (var i=0;  i<paramsAttr.length ; i++){
        var paramId = paramsAttr[i].paramId;
    }
    return response;
}

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
    if (minValue>maxValue){
        var tmp = maxValue;
        maxValue = minValue;
        minValue = tmp;
    }
    if (!isNaN(value) && !isNaN(minValue) && !isNaN(maxValue)){
        response = ((value) / (maxValue - minValue));
    }
    return response;
}

function getChartCalcValues(paramsAttr, rawDatatableData)
{
    //transform ton paramsAttr array avec paramId qui fait l'index
    var paramsAttrByKeyId = transformParamAttrArray(paramsAttr);

    var response = {};
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
                //rawDatatableData[i][Object.keys(serie)[j]] = calcValue;
                tmpTab[j] = calcValue;
            }else{
                //rawDatatableData[i][Object.keys(serie)[j]] = value;
                tmpTab[j] = value;
            }
        }
        tab.push(tmpTab);
    }
    return tab;
}