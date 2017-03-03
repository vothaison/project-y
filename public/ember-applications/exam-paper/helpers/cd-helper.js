Ember.Helper.helper(
    (function(){
        var map = {
            '0': 'C',
            '1': 'D',
        };

        return function (params) {
            var value = params[0];
            return map[value];
        }
    }())
);
