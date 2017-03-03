Ember.Component.extend({
    tagName: 'div',
    classNames: ['page'],
    classNameBindings: ['noQuestion:hide'],

    attributeBindings: ['size'],
    nextQuestionIndex: 0,

    trialQuestion: undefined,
    trialLines: 0,

    addQuestion: function () {
        var _self = this;
        var questions = this.get('questions');
        var questionList = this.get('questionList');
        var questionIndex = this.get('questionIndex');

        if(!questions[questionIndex]) return;

        if(!questions[questionIndex].question_id){
            _self.set('questionIndex', questionIndex + 1);
            _self.addQuestion();
        }

        questionList.pushObject(questions[questionIndex]);
        Ember.run.next(function () {
            var meterHeight = _self.$('.meter').height();
            var thisHeight = _self.$().height();
            //console.log('this height', $('.page').height(), 'meter height', $('.page .meter').height());

            if (meterHeight < thisHeight) {
                _self.set('questionIndex', questionIndex + 1);
                _self.addQuestion();
            }
            else {
                _self.removeLastQuestion().then(function(){
                    Ember.run.next(function () {
                        _self.sendAction('changePageSize',
                            _self.get('pageIndex'),
                            0,
                            _self.get('questionIndex') - 1);
                    });
                });
            }
        })
    },

    removeLastQuestion: function () {
        var _self = this;

        return new Promise(function(resolve, reject) {
            Ember.run.next(this, function () {
                var questionList = _self.get('questionList');
                questionList.removeAt(questionList.length - 1);
                Ember.run.next(function(){
                    resolve();
                });
            });
        });
    },

    tryAddQuestions: function () {
        var questions = this.get('questions');
        if(!questions) {
            this.set('trialQuestion', null);
            this.set('noQuestion', true);
            return;
        } else {
            this.set('noQuestion', false);
        }
        var _self = this;

        this.set('questionIndex', 0);
        this.tryOneQuestion();

    },

    trialQuestionObserver: Ember.observer('trialQuestion', function(){
       console.log('trialQuestion changed ', this.get('trialQuestion'))
    }),

    tryOneQuestion: function () {
        var _self = this;

        var questionIndex = this.get('questionIndex');
        var questions = this.get('questions');

        var targetQuestion = questions[questionIndex];



        if (!targetQuestion) {
            this.set('trialQuestion', null);
            this.set('questionIndex', 0);
            this.addQuestion();
            return;
        } else {
        }

        if(!targetQuestion.question_id){
            _self.set('questionIndex', questionIndex + 1);
            _self.tryOneQuestion();
        }

        var promises = [];
        this.set('promises', promises);
        this.set('trialQuestion', questions[questionIndex]);

        Ember.run.next(this, function () {
            Promise.all(promises).then(function (values) {
                //console.log('all promises', values);
                Ember.set(targetQuestion, '_answerLines_', values[0]);
                _self.set('questionIndex', questionIndex + 1);
                _self.tryOneQuestion();
            });
        })
    },

    onQuestionsChange: Ember.observer('questions.[]', function () {
        var _self = this;
        this.set('questionList', []);
        this.tryAddQuestions();

    }),

    onInit: function(){
        this.set('questionList', []);

    }.on('init'),

    didInsertElement: function(){
        this.tryAddQuestions();

    }
});
