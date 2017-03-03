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

        Ember.set(role, '__deleting__', true);

        $.post(url, {
            user_id: this.get('user_id'),
            role_id: role.role_id
        }, function (o) {
            if (o.result) {
                // success
                Ember.set(role, '__deleted__', true);
                Ember.run.later(function () {
                    _self.get('roles').removeObject(role);
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
        startAddRole: function() {
            console.log('startAddRole');
            this.transitionToRoute('add-role')
        },

        revokeRole: function (role) {
            this.set('dialogYesNo.visible', true);
            this.set('dialogYesNo.title', 'Revoke this role?');
            this.set('dialogYesNo.content', 'Click Yes to confirm');
            this.set('dialogYesNo.clickYes', 'doRevokeRole');
            this.set('dialogYesNo.clickYesParam', role);
        },

        doRevokeRole: function (role) {
            this.doRevokeRole(role);
        }
    }
});
