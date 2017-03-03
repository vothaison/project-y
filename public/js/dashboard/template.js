var Template = function(){

    this.__construct = function(){
        console.log("Template created")
    }

    this.todo = function(obj){
        var output = '';
        output += '<li class="list-group-item" id="todo_' + obj.todo_id + '">'
        //output +=    '<h4 class="list-group-item-heading">' + obj.todo_id + '</h4>';
        output +=    '<p class="list-group-item-text">' + obj.content + '</p>';
        output +=  '</li>';
        return output;
    }



    this.__construct();
}