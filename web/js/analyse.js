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
});

