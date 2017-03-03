Ember.Helper.helper(
    (function(){
        var map = {
            '0': 'A',
            '1': 'B',
            '2': 'C',
            '3': 'D',
            '4': 'E'
        };

        return function (params) {
            var value = params[0];
            return map[value];
        }
    }())
);
