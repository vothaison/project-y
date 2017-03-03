Ember.Component.extend({
    visible: false,
    title: '',
    content: '',
    yes: 'Yes',
    no: 'No',
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
        clickNo: function () {
            console.log('clickNo');

            this.$('[role="dialog"]').modal('hide');
        },

        clickYes: function () {
            console.log('clickYes');

            this.$('[role="dialog"]').modal('hide');
            this.sendAction('clickYes', this.get('clickYesParam'));

        }
    }
});