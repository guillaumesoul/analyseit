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

    $('#chart_button').on('click', function(){

        //get the data from datatable
        var dtData = dataTable.data();
        var datatable_inputs = dataTable.$('input');
        //cut your inputs into row
        var tmpTab = [];
        var serieTab = [];
        for (var i=0 ; i<datatable_inputs.length ; i++){
            tmpTab[$(datatable_inputs[i]).attr('index')] = $(datatable_inputs[i]).val();



            var inputNbrByRow = dataTable.$('input').length / (dtData.length);
            if (i%inputNbrByRow == inputNbrByRow-1) {
                serieTab.push(tmpTab);
            }
        }
        console.log(serieTab);

        //get data from analyse
    });


    function DataSerie ( name, paramData ) {

        this.name = name;
        this.position = position;
        this.salary = salary;
        this._office = office;

        this.office = function () {
            return this._office;
        }
    };

    /*function Employee ( name, position, salary, office ) {
        this.name = name;
        this.position = position;
        this.salary = salary;
        this._office = office;

        this.office = function () {
            return this._office;
        }
    };*/

    /*$('#example').DataTable( {
        "searching": false,
        "info" : false,
        "bLengthChange": false,
        "paging" : false,
        data: [
            new Employee( "Tiger Nixon", "System Architect", "$3,120", "Edinburgh" ),
            new Employee( "Garrett Winters", "Director", "$5,300", "Edinburgh" )
        ],
        columns: [
            { data: 'name' },
            { data: 'salary' },
            { data: 'office' },
            { data: 'position' }
        ]
    } );*/





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

