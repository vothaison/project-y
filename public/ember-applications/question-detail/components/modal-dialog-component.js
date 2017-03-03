Ember.Component.extend({
    visible: false,
    title: '',
    content: '',

    didInsertElement: function(){
        var _self = this;

        this.$('[role="dialog"]').on('hidden.bs.modal', function (e) {
            _self.set('visible', false);
        })
    },

    visibleObserver: Ember.observer('visible', function () {
        var visible = this.get('visible');
        if (visible) {
            this.$('[role="dialog"]').modal('show');
        } else {
            this.$('[role="dialog"]').modal('hide');
        }
    }),
    actions: {
        revokeRole: function () {
            var role = this.get('role');
            this.sendAction('action', role);
        }
    }
});