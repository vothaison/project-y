var Result = function () {
    this.__construct = function () {
        console.log("Result created");

    }

    this.success = function (msg) {
        var successContainer = $('#alert-success');
        successContainer.parent().show();
        if (!msg) {
            console.log('SUCCESS');
            successContainer.append('<li>' + 'SUCCESS' + '</li>');
        } else {
            successContainer.append('<li>' + msg + '</li>')
        }

        setTimeout(function(){
            successContainer.parent().hide();
        }, 5000)
    }

    this.error = function (msg) {
        var errorContainer = $('#alert-error');
        errorContainer.parent().show();
        if (!msg) {
            console.log('ERROR OCCURRED');
            errorContainer.append('<li>' + 'ERROR' + '</li>');
        } else if (typeof(msg) == 'string') {
            errorContainer.html('<li>' + msg + '</li>');
        } else if (typeof(msg) == 'object') {
            for (var key in msg) {
                var error = '<li>' + msg[key] + '</li>';
                errorContainer.append(error);
            }
        }

        setTimeout(function(){
            errorContainer.parent().hide();
        }, 5000)
    }

    this.__construct();
}
