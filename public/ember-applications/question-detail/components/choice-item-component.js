Ember.Component.extend({
    tagName: 'li',
    attributeBindings: ['style'],
    classNames: ['list-group-item'],
    style: Ember.String.htmlSafe('padding: 5px 10px'),

    deleted: Ember.observer('role.__deleted__', function () {
        console.log('deleted ', this.get('role'));
        this.get('revokeButton').button('reset');
        this.$().fadeOut(1000);
    }),

    deleting: Ember.observer('role.__deleting__', function () {
        console.log('deleting ', this.get('role'));
        this.set('revokeButton', this.$('[role="button-revoke"]').button('loading'));
    }),

    actions: {
        revokeRole: function () {
            var role = this.get('role');
            this.sendAction('action', role);
        }
    }
});
