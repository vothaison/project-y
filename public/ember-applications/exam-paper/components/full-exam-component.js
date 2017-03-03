Ember.Component.extend({
    tagName: '',
    page01: undefined,
    page02: undefined,
    page03: undefined,
    page04: undefined,
    page05: undefined,

    onInit: function(){
        var questions = this.get('questions');
        this.set('page01', questions);
    }.on('init'),

    didInsertElement: function(){
        var questions = this.get('questions');
        this.set('page01', questions);
    },

    actions: {
        changePageSize: function (pageIndex, from, to) {
            if(pageIndex >= 5) {
                alert('You cannot have more than 5 pages in one exam paper.');
                return;
            }
            console.log('changePageSize', pageIndex, from, to);
            var pageName='page0' + pageIndex;
            var nextPageName = 'page0' + (pageIndex + 1);

            var previousPage = this.get(pageName);
            var nextSubset = previousPage.slice(to + 1, previousPage.length);
            Ember.run.next(this, function(){
                this.set(nextPageName, nextSubset);

            });

        }
    }
});
