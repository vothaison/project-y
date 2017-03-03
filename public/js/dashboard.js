var Dashboard = function(){
    var Template;
    var Event;
    var Result;

    this.__construct = function(){
        console.log("Dashboard created");
        Template = new window.Template();
        Event = new window.Event();
        Result = new window.Result();

        //get_todo();
    }

    var get_todo = function(){
        $.get('api/get_todo', function(o){
            var listTodo = $('#list_todo');
            var output = '';
            for(var i = 0, l = o.length; i<l; i++){
                output += Template.todo(o[i]);
            }
            listTodo.html(output);
        }, 'json');
    }



    this.__construct();
}
$(function(){
    new Dashboard();
});
