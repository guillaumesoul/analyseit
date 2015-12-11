/**
 * Created by guillaumesoullard on 09/12/15.
 */


$(document).ready(function() {

    $('.analyse_thumbnail').on('click', function(){
        $('.analyse_thumbnail').removeClass('thumbnail_active');
        $(this).addClass('thumbnail_active');
    });

    $('#param_datatable').dataTable({
        "searching": false,
        "info" : false,
        "bLengthChange": false
    });

    /*$('.paramDelete').on('click', function(){
        //get the id
        var paramId = $(this).val();
        var url = '/param/delete/' + paramId;
        console.log(url);
        //envoi une requete pour supprimer le param
        $.ajax({
            url: url,
            success: function(){
                console.log('success ajax');
            }

        })
        console.log($(this).val());
        console.log($(this).closest('.paramId'));
        console.log($(this).closest('tr'));
        console.log($(this).closest('tr').find('.paramId'));
    });*/

});

