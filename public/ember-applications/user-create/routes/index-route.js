Ember.Route.extend({
    model: function(){
        $('title').text('User Information');
        return {};
    },

    setupController: function (controller, model) {
        this._super(controller, model);

        controller.set('title', 'User Information');
    }
});
