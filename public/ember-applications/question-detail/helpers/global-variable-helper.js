Ember.Helper.helper(function (params) {
    var value = params[0];
    return Ember.get(window, value);
});
