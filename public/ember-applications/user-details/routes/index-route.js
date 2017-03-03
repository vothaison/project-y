Ember.Route.extend({
    model: function(){
        $('title').text('Details for user '+ Data.SessionData.Login);
        return {};
    },

    setupController: function (controller, model) {
        this._super(controller, model);

        controller.set('title', 'Users and Role');
        controller.set('roles', Data.Roles);
        controller.set('privilegeActions', Data.PrivilegeActions);
        controller.set('user_id', Data.SessionData.PageData.UserInfo['user_id']);

    }
});