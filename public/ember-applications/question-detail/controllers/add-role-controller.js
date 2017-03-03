Ember.Controller.extend({
    dialog: {
        visible: false,
        title: '',
        content: ''
    },

    dialogYesNo: {
        visible: false,
        title: '',
        content: '',
        clickYes: '',
    },

    doRevokeRole: function (role) {
        var _self = this;
        var url = Data.SessionData.SiteUrl + '/' + 'user/revoke_role';

        Ember.set(role, '__revoking__', true);

        $.post(url, {
            user_id: this.get('user_id'),
            role_id: role.role_id
        }, function (o) {
            if (o.result) {
                // success
                Ember.set(role, '__revokedAway__', true);

                Ember.run.later(function () {
                    _self.get('model.unmappedRoles').addObject(Object.assign({}, role));
                    _self.get('model.mappedRoles').removeObject(role);
                }, 1000)
            } else {
                // error
                _self.set('dialog.visible', true);
                _self.set('dialog.title', 'An error has occurred');
                _self.set('dialog.content', 'Please refresh the page. See if it helps.');
            }
        }, 'json');
    },

    doAddRole: function (role) {
        var _self = this;
        var url = Data.SessionData.SiteUrl + '/' + 'user/add_role';

        Ember.set(role, '__adding__', true);

        $.post(url, {
            user_id: this.get('user_id'),
            role_id: role.role_id
        }, function (o) {
            if (o.result) {
                // success
                Ember.set(role, '__addedAway__', true);

                Ember.run.later(function () {
                    _self.get('model.mappedRoles').addObject(Object.assign({}, role));
                    _self.get('model.unmappedRoles').removeObject(role);
                }, 1000)
            } else {
                // error
                _self.set('dialog.visible', true);
                _self.set('dialog.title', 'An error has occurred');
                _self.set('dialog.content', 'Please refresh the page. See if it helps.');
            }
        }, 'json');
    },

    actions: {
        back: function() {
            console.log('BACK', this.get('model'));
            this.transitionToRoute('index');
        },

        addRole: function(role) {
            console.log('addRole', role);
            this.doAddRole(role);
        },

        revokeRole: function (role) {
          this.doRevokeRole(role);
        },
    }
});
