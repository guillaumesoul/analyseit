/**
 * Created by guillaumesoullard on 09/12/15.
 */


$(document).ready(function() {

    $('#param_datatable').dataTable({
        "searching": false,
        "info" : false
    });

    $('.analyse_thumbnail').on('click', function(){
        $('.analyse_thumbnail').removeClass('thumbnail_active');
        $(this).addClass('thumbnail_active');
    });

});

