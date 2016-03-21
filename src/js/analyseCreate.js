/**
 * Created by guillaumesoullard on 07/02/16.
 */


/*  */
typeParamArray = {
    1: 'Number',
    2: 'Text',
    3: 'Date',
    4: 'Time',
    5: 'Localization',
    6: 'Money',
};



/*$(document).ready(function()
{
    bindInputValidation();

    $('#form_file').on('change', function(){
        var filename = $('#form_file').val().replace(/^.*[\\\/]/, '');
        $('#form_name').val(filename);
        //on desactive le form submit si pas de fichier ou si fichier pas excel

    });

    //ok mainteant j'ai ma var excelData et je veux alimenter mon tableau avec ce qu'il y a dedans
    var parsedExcelData = $.parseJSON(excelData);
    var analyse = new Analyse();
    var params = [];
    var dataseries = [];
    var nbParam = parsedExcelData[0].length;
    var rowNumber = parsedExcelData.length;
    for(var i=0; i<rowNumber ; i++){
        var dataserie = new Dataserie();
        for(var j=0; j<nbParam ; j++){
            if(i=0){
                var param = new Param(parsedExcelData[i][j]);
            }
            var value = new Value();
            value.value = parsedExcelData[i][j];
            params.push(param);
            dataserie.values.push(value);

        }
        dataseries.push(dataserie);
    }

    analyse.paramList = params;
    analyse.dataseries= dataseries;
    analyse.name= 'from excel';
    analyse.description= 'excel description';
    analyseInit = analyse;
    //console.log(analyseInit);

    //COMMENT UPDATER ANGULAR???



});*/

