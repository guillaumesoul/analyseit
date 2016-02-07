/**
 * Created by guillaumesoullard on 07/02/16.
 */



/*
* ANGULAR TEST
* */

/*angular.module('datatalkApp', [])
    .controller('TodoListController', function() {
        var todoList = this;
        todoList.todos = [
            {text:'learn angular', done:true},
            {text:'build an angular app', done:false}];

        todoList.addTodo = function() {
            todoList.todos.push({text:todoList.todoText, done:false});
            todoList.todoText = '';
        };

        todoList.remaining = function() {
            var count = 0;
            angular.forEach(todoList.todos, function(todo) {
                count += todo.done ? 0 : 1;
            });
            return count;
        };

        todoList.archive = function() {
            var oldTodos = todoList.todos;
            todoList.todos = [];
            angular.forEach(oldTodos, function(todo) {
                if (!todo.done) todoList.todos.push(todo);
            });
        };
    });*/

angular.module('datatalkApp', [])
    .controller('ParamListController', function() {
        var paramList = this;
        paramList.params = [
            {name:'param1', value:'80'},
            {name:'param2', value:'66'}];

        paramList.addParam = function() {
            paramList.params.push({name:paramList.paramName, value:'37'});
            paramList.paramName = '';
        };

        /*paramList.remaining = function() {
            var count = 0;
            angular.forEach(todoList.todos, function(todo) {
                count += todo.done ? 0 : 1;
            });
            return count;
        };

        paramList.archive = function() {
            var oldTodos = todoList.todos;
            todoList.todos = [];
            angular.forEach(oldTodos, function(todo) {
                if (!todo.done) todoList.todos.push(todo);
            });
        };*/
    });







/*var analyse = initAnalyse(3);
console.log(analyse);*/

//FONCTION INIT pour initialiser l'analyse avec 3 parametres et une dataserie
//je veux construire object js de type array de 3 param

//constructeur sans param
function Analyse () {
    this.name = 'nouvelle analyse';
    this.description = 'description';
    this.paramList = {};
    this.dataserie = {};
}

//constructeur avec param
function Analyse (name, description, paramList, dataserie) {
    this.name = name;
    this.description = description;
    this.paramList = paramList;
    this.dataserie = dataserie;
}

//constructeur sans param
function Param () {
    this.name = '';
    this.minVal = '';
    this.maxVal = '';
    this.ponderation = '';
    this.unit = '';
    this.type = '';
}

//constructeur avec param
function Param (name, minValue, maxValue, ponderation, unit, type) {
    this.name = name;
    this.minVal = minValue;
    this.maxVal = maxValue;
    this.ponderation = ponderation;
    this.unit = unit;
    this.type = type;
}

//constructeur dataserie
function Dataserie (name) {
    this.name = name;
}

//constructeur sans param
function Value () {
    this.dataserie = '';
    this.param = '';
    this.value = '';
}


//constructeur avec param
function Value (dataserie, param, value) {
    this.dataserie = dataserie;
    this.param = param;
    this.value = value;
}

/*
* creation des differents object js pour le nbParam specifies
* @param int nbParam : nombre de parametres avec lequel initalisé le tableau
* */
function initAnalyse(nbParam)
{
    //on intialise avec 3 parametre et 1 serie de données
    var analyse = new Analyse();
    var paramList = {};
    var dataserie = {};
    if(typeof nbParam == 'number')
    {
        for(var i= 0; i<parseInt(nbParam) ; i++){
            var newParam = new Param();
            newParam.name = 'param'+i;
            paramList[i] = newParam;
            var newValue = new Value();
            newValue.param = newParam.name;
            dataserie[i] = newValue;
        }
    }
    var analyse = new Analyse();
    //console.log(analyse);
    analyse.paramList = paramList;
    analyse.dataserie= dataserie;
    analyse.name= 'new analyse';
    analyse.description= 'description';
    return analyse;
}

//et une dataserie avec ces 3 params