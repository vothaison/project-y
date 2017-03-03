Ember.Component.extend({
    visible: false,
    title: '',
    content: '',

    didInsertElement: function(){
        var _self = this;

        this.$('[role="dialog"]').on('hidden.bs.modal', function (e) {
            _self.set('dialog.visible', false);
        })
    },

    visibleObserver: Ember.observer('dialog.visible', function () {
        var visible = this.get('dialog.visible');
        if (visible) {
            this.$('[role="dialog"]').modal({ backdrop: this.get('dialog.backdrop'),  keyboard: this.get('dialog.keyboard'),});
        } else {
            this.$('[role="dialog"]').modal('hide');
        }
    }),
    actions: {
        close: function () {
            this.$('[role="dialog"]').modal('hide');
        }
    }
});
