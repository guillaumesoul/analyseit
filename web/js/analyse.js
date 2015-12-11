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

    $('#addRowDataTable').on('click', function() {
        dataTable.row.add(dataTable.rows(0).data()[0]).draw(false);
    });




});

