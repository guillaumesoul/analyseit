/**
 * Created by guillaumesoullard on 09/12/15.
 */


$(document).ready(function() {

    $('#example').dataTable({
        searching: false
    });

    $('.analyse_thumbnail').on('click', function(){
        $('.analyse_thumbnail').removeClass('thumbnail_active');
        $(this).addClass('thumbnail_active');
    });

});

