Ember.Controller.extend({
    setDialogInstance: function (newDialogInstance) {
        var dialogInstance = this.get('dialogInstance');
        ['title', 'content', 'linkButtons', 'actionButtons', 'showCloseButton', 'backdrop', 'keyboard', 'visible']
            .forEach(function (item) {
                Ember.set(dialogInstance, item, Ember.get(newDialogInstance, item))
            });
    },

    dialogInstance: {
        visible: false
    },

    dialogSaveSuccess: {
        visible: true,
        title: 'Saved successfully',
        content: 'Where to go next?',
        showCloseButton: false,
        backdrop: 'static',
        keyboard: false,
        linkButtons: [
            {
                text: 'Back to List',
                href: Data.SessionData.BackUrl
            },
            {
                text: 'Go to Details',
                href: Data.SessionData.DetailsUrl
            }]
    },

    dialogSaveFailed: {
        visible: true,
        title: 'An error has occurred',
        content: 'Please refresh the page. See if it helps.',
        backdrop: true,
        keyboard: true,
    },

    dialogForm: {
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

    actions: {
        save: function () {
            var _self = this;
            var url = Data.SessionData.PostCreateUrl;

            var postData = {
                login: this.get('login'),
                email: this.get('email'),
                password: this.get('password')
            };

            $.post(url, postData, function (o) {
                if (o.result === 1) {
                    var detailUrl = Data.SessionData.DetailsUrl + '?login=' + _self.get('login') + '&back_url=' + Data.SessionData.ListUrl;
                    _self.set('dialogSaveSuccess.linkButtons.1.href', detailUrl);

                    _self.setDialogInstance(_self.get('dialogSaveSuccess'));

                } else {
                    _self.setDialogInstance(_self.get('dialogSaveFailed'));
                }
            }, 'json');

        }
    }
});
