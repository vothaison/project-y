Ember.Route.extend({
    model: function(){
        $('title').text('Details for user '+ Data.SessionData.Login);
        return {};
    },

    setupController: function (controller, model) {
        this._super(controller, model);

        controller.set('title', 'Question Detail');
        controller.set('question_id', Data.SessionData.PageData.QuestionInfo['question_id']);
        controller.set('question', Data.SessionData.PageData.QuestionInfo);

    }
});