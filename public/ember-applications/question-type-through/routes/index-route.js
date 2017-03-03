Ember.Route.extend({
    model: function(){

        //model.questions = model.questions.slice(0, 3);
        return {};
    },



    setupController: function (controller, model) {
        this._super(controller, model);
        // Set the IndexController's `title`
        controller.set('title', 'Question Type Through');
    }
});
