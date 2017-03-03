Ember.Component.extend({
    tagName: 'div',
    classNames: ['whole-question'],
    classNameBindings: ['isNegativeLine:is-underlined-question', 'isRewriting:is-rewriting-question', ],

    isNegativeLine: Ember.computed.alias('question.is_underlined_question'),
    isRewriting: Ember.computed.alias('question.is_rewriting'),

    question: Ember.computed.alias('item'),

    firstTwo: Ember.computed('question.choices.[]', function(){
        var choices = this.get('question.choices');
        if(!choices) return [];
      return this.get('question.choices').slice(0, 2);
    }),

    lastTwo: Ember.computed('question.choices.[]', function(){
        var choices = this.get('question.choices');
        if(!choices) return [];
      return this.get('question.choices').slice(2, 4);
    }),
    question_index: Ember.computed.alias('question.question_id'),

    map: {'0': 'A', '1': 'B', '2': 'C', '3': 'D'},

    didInsertElement: function() {
      var question = this.get('question');
        if(question._answerLines_ === -1){


        var text = this.$('[role="question_text"]').html();
        position = 0;
        var map = this.get('map');
        text = text.replace(/\[(.*?)\]/g, function(match, contents, offset, s) {
            return "<span class=\"under-choice\" data-descr=\""+ map[position++] +"\">"+contents+"</span>";
        });

        this.$('[role="question_text"]').html(text);
      }
    },
    actions: {

    }
});
