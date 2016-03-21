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
    this.type = 1;  //type number see $scope.typeparamOptions in analyseAngular.js
}
function Dataserie () {
    this.name = '';
    this.values = [];
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
Value.prototype.isValid = function(typeParamText){
    var response = false;
    switch(typeParamText){
        case 'Number':
            response = this.isValidNumber();
            break;
        case 'Text':
            response = this.isValidText();
            break;
    }
    return response;
}

Value.prototype.isValidNumber = function(){
    var response = false;
    (isNaN(this.value)) ? response = 'number required !!!' : response = true;
    return response;
}

Value.prototype.isValidText = function(){
    var response = 'text required!';
    //(isNaN(this.value)) ? response = false : response = true;
    return response;
}