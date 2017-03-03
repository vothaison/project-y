Ember.Component.extend({
    tagName: 'li',
    attributeBindings: ['style'],
    classNames: ['list-group-item'],
    style: Ember.String.htmlSafe('padding: 5px 10px'),

    addedAway: Ember.observer('role.__addedAway__', function(){
        console.log('addedAway ', this.get('role'));
        this.get('addRoleButton').button('reset');
        this.$().fadeOut(1000);
    }),

    adding: Ember.observer('role.__adding__', function(){
        console.log('adding ', this.get('role'));
        this.set('addRoleButton', this.$('[role="button-revoke"]').button('loading'));
    }),

    revokedAway: Ember.observer('role.__revokedAway__', function(){
        console.log('revokedAway ', this.get('role'));
        this.get('addRoleButton').button('reset');
        this.$().fadeOut(1000);
    }),

    revoking: Ember.observer('role.__revoking__', function(){
        console.log('revoking ', this.get('role'));
        this.set('addRoleButton', this.$('[role="button-revoke"]').button('loading'));
    }),

    actions: {
        addOrRevokeRole: function(){
            var role = this.get('role');
            this.sendAction('action', role);
        }
    }
});
