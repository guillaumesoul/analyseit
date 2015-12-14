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

    /*myFather.name = function () {
        return this.firstName + " " + this.lastName;
    };*/

    dataTable.getRawData = function(){
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
                //console.log(seriesTab);
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



    $('#chart_button').on('click', function(){

        var rawDatatableData = dataTable.getRawData();

        if ( $.fn.dataTable.isDataTable( '#example' ) ) {
            $('#example').DataTable().destroy();
        }
        var workTab = $('#example').DataTable( {
            "searching": false,
            "info" : false,
            "bLengthChange": false,
            "paging" : false,
            data: rawDatatableData.seriesData,
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

/*
function getDatatableRawData(dataTable)
{
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
        //console.log(temp);
        if (i<inputNbrByRow) {
            indexTab[i] = $(datatable_inputs[i]).attr('index');
        }
        if (i%inputNbrByRow == inputNbrByRow-1) {
            temp2Associative = tempAssociative;
            temp2 = temp;
            seriesTab[cpt] = temp2;
            //console.log(seriesTab);
            seriesTabAssociative[cpt] = temp2Associative;
            cpt++;
            temp = [];
            tempAssociative = {};
        }
    }

    //console.log(indexTab);
    //console.log(seriesTab);
    //console.log(seriesTabAssociative);

    var response = {};
    response.index = indexTab;
    response.seriesData = seriesTab;
    response.seriesDataAssociative = seriesTabAssociative;
    return response;
}*/
