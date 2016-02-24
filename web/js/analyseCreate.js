/**
 * Created by guillaumesoullard on 07/02/16.
 */


typeParamArray = {
    1: 'Number',
    2: 'Text',
    3: 'Date',
    4: 'Time',
    5: 'Localization',
    6: 'Money',
};


var analyseInit = initAnalyse(3);

$(document).ready(function()
{
    bindInputValidation();

    var files;
    $('#fileToImport').on('change', function(){
        files = event.target.files;
    });
    $('#fileImport').on('click',uploadFiles);



    //$('form').on('submit', uploadFiles);

    // Catch the form submit and upload the files
    function uploadFiles(event)
    {
        event.stopPropagation(); // Stop stuff happening
        event.preventDefault(); // Totally stop stuff happening

        // START A LOADING SPINNER HERE

        // Create a formdata object and add the files
        var data = new FormData();
        $.each(files, function(key, value)
        {
            data.append(key, value);
        });

        $.ajax({
            //url: 'submit.php?files',
            url: 'upload',
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            success: function(data, textStatus, jqXHR)
            {
                if(typeof data.error === 'undefined')
                {
                    // Success so call function to process the form
                    submitForm(event, data);
                }
                else
                {
                    // Handle errors here
                    console.log('ERRORS: ' + data.error);
                }
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                // Handle errors here
                console.log('ERRORS: ' + textStatus);
                // STOP LOADING SPINNER
            }
        });
    }

});

//fonction permettant d'ajuster la width de id="panelAnalyseEdition" en fonction du nombre de param
function updateView(nbParam)
{
    ($('.paramInfo li').width()*nbParam < window.screen.width) ? $('#panelAnalyseEdition').width(window.screen.width) : $('#panelAnalyseEdition').width($('.paramInfo li').width()*nbParam+100);
}

/*
* creation des differents object js pour le nbParam specifies
* @param int nbParam : nombre de parametres avec lequel initalisé le tableau
* */
function initAnalyse(nbParam)
{
    var analyse = new Analyse();
    var params = [];
    var dataseries = [];
    if(nbParam === parseInt(nbParam, 10)){
        var dataserie = new Dataserie('new dataset',nbParam);
        dataseries.push(dataserie);
        for(var i= 1; i<=parseInt(nbParam) ; i++){
            var newParam = new Param('param'+i);
            params.push(newParam);
        }
    }
    analyse.paramList = params;
    analyse.dataseries= dataseries;
    analyse.name= 'new analyse';
    analyse.description= 'description';
    return analyse;
}

function processDatasetsWithParamData(allParamsInfo,datasetData)
{
    var valueInit = 0;
    var minVal = 0;
    var maxVal = 0;
    var processedValue = 0;
    var processedDatasetValues = [];
    //@todo set best min val regarding range through all dataseries
    for(var j=0 ; j<datasetData.length ; j++){
        valueInit = datasetData[j];
        (allParamsInfo[j].minVal == '') ?   minVal = 0 : minVal = parseFloat(allParamsInfo[j].minVal);
        (allParamsInfo[j].maxVal == '') ?   maxVal = 100 : maxVal = parseFloat(allParamsInfo[j].maxVal);
        processedValue = (valueInit-minVal)/(maxVal-minVal)*100;
        processedDatasetValues[j] = processedValue;
    }
    return processedDatasetValues;
}

//generate a new RGB color for chart dataserie in output format = "R,G,B"
function generateNewColor()
{
    var randR = Math.floor((Math.random() * 255) + 1);
    var randG = Math.floor((Math.random() * 255) + 1);
    var randB = Math.floor((Math.random() * 255) + 1);
    var color = randR+","+randG+","+randB;
    return color;

}


// détection a la volee de la validite de la saisi en fonction du type de parametre sélectionné
// un bon format est defini par le type de parametre en haut de la colonne
function bindInputValidation()
{
    $('.dataserieValue, .paramMinValue, .paramMaxValue, .paramPonderation').bind('input', function() {
        var objectValue = new Value();
        objectValue.value = $(this).val();
        //get type param in text : 'Number', 'Text' etc...
        var typeParamText = typeParamArray[$(".paramData[paramIndex='" + $(this).attr('dataserieIndex') + "'] .typeParam").val()];
        var validationTest = objectValue.isValid(typeParamText);
        if(validationTest != true){
            $(this).notify(validationTest,{autoHideDelay: 750});
            $(this).addClass('alert-danger');
        }else{
            if($(this).hasClass('alert-danger')) $(this).removeClass('alert-danger');
        }
    });
}