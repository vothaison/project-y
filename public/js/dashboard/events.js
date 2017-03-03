var Event = function(){

    var Result;
    var Template;

    this.__construct = function(){
        console.log("Event created");
        create_todo();
        //update_todo();
        //delete_todo();
        Result = new window.Result();
        Template = new window.Template();

    }

    var create_todo = function(){
        $('#create_todo_form').submit(function(e){
            e.preventDefault();
            console.log("create_todo_form submit");

            var url = $(this).attr('action');
            var postData = $(this).serialize();
            $.post(url, postData, function(o){
                if(o.result){
                    console.log('OK');
                    Result.success();

                    var listTodo = $('#list_todo');
                    var output = Template.todo(o.data[0]);
                    listTodo.prepend(output);
                }else{
                    console.log('Error');
                    Result.error(o.errors);
                }
            }, 'json');

            return false;
        });
    }

    var update_todo = function(){
        $('#create_todo_form').submit(function(e){
            e.preventDefault();

            console.log("create_todo_form submit");
            return false;

        });
    }

    var delete_todo = function(){
        $('#create_todo_form').submit(function(e){
            e.preventDefault();

            console.log("create_todo_form submit");
            return false;

        });
    }

    this.__construct();
}
