Ember.Helper.helper(function (params) {

    var item = params[0];

    if(item.question_id !== undefined){
        //console.log('its a whole-question');
        return 'whole-question';
    }

    if(item.text_id !== undefined) {
        //console.log('its a text-passage');
        return 'text-passage';
    }
});
