/**
 * Created by guillaumesoullard on 11/02/16.
 */

/* BEGIN CONSTRUCTORS */
function Analyse () {
    this.name = 'nouvelle analyse';
    this.description = 'description';
    this.paramList = {};
    this.dataserie = {};
}
function Param (name) {
    this.name = name;
    this.minVal = '';
    this.maxVal = '';
    this.ponderation = '';
    this.unit = '';
    this.type = '';
}
function Dataserie (name, nbvalues) {
    this.name = name;
    this.values = [];
    if(nbvalues === parseInt(nbvalues, 10)){
        for(var i=0; i<nbvalues; i++){
            var newValue = new Value();
            this.values.push(newValue);
        }
    }
}
function Value () {
    this.dataserie = '';
    this.param = '';
    this.value = Math.floor((Math.random() * 100) + 1);
}
/* END CONSTRUCTOR */

//je veux faire la validation de mes inputs

//2 solution : verify notify et angular
//1 - architecture faire des objects de type value auxquels on va appliquer des prototype de méthodes
// ex : Value.isValidNumber();
//du coup faire des objets héritant de classe value : ValueNumber, ValueString, ValueDate, ValueChoiceList, ValueTime


//1 - Utilisation de prototype
Value.prototype.isValidNumber = function(){
    (isNaN(this.value)) ? response = false : response = true;
    $('.dataserieValue').notify("Number required");
    return response;
}