Ember.Helper.helper(
    (function(){
        var map = {
            '0': 'A',
            '1': 'B',
        };

        return function (params) {
            var value = params[0];
            return map[value];
        }
    }())
);
