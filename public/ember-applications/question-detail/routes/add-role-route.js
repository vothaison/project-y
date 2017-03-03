Ember.Route.extend({
    model: function() {
        $('title').text('Add roles for user '+ Data.SessionData.Login);

        var getUnmapped = new Promise(function(resolve, reject) {
            var url = Data.SessionData.SiteUrl + '/' + 'user/get_unmapped_roles?user_id=' + Data.SessionData.PageData.UserInfo['user_id'];
            Ember.$.getJSON(url).then(function(data){
                resolve(data);
            });
        });

        var getMapped = new Promise(function(resolve, reject){
            var url = Data.SessionData.SiteUrl + '/' + 'user/get_mapped_roles?user_id=' + Data.SessionData.PageData.UserInfo['user_id'];
            Ember.$.getJSON(url).then(function(data){
                resolve(data);
            });
        });

        return new Ember.RSVP.Promise(function(resolve) {

            Promise.all([
                getUnmapped,
                getMapped
            ]).then(function (values) {
                resolve({
                    unmappedRoles: values[0].result,
                    mappedRoles: values[1].result,
                });
            });
        });
    },

    setupController: function (controller, model) {
        this._super(controller, model);
        controller.set('user_id', Data.SessionData.PageData.UserInfo['user_id']);
        controller.set('model', model);

    }
});
