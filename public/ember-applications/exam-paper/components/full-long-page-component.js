Ember.Component.extend({
    tagName: 'div',
    classNames: ['full-long-page'],
    classNameBindings: ['noQuestion:hide'],

    attributeBindings: ['size'],
    nextQuestionIndex: 0,

    trialQuestion: undefined,
    trialLines: 0,

    questions: Ember.computed.alias('wholeExam.questions'),

    addQuestion: function () {
        var _self = this;
        var questions = this.get('questions');
        var questionList = this.get('questionList');
        var questionIndex = this.get('questionIndex');

        if (!questions[questionIndex]) return;

        if (questions[questionIndex].question_id === undefined) {
            _self.set('questionIndex', questionIndex + 1);
            _self.addQuestion();
        }

        questionList.pushObject(questions[questionIndex]);
        Ember.run.next(function () {
            _self.set('questionIndex', questionIndex + 1);
            _self.addQuestion();
        })
    },

    tryAddQuestions: function () {
        this.set('questionIndex', 0);
        this.tryOneQuestion();

    },

    tryOneQuestion: function () {
        var _self = this;

        var questionIndex = this.get('questionIndex');
        var questions = this.get('questions');

        // No more question to process
        if (questionIndex >= questions.length) {
            this.set('trialQuestion', null);
            this.set('questionIndex', 0);
            //this.addQuestion();
            Ember.run.once(this, function () {
                console.log('questions', questions);
                this.set('questionList', questions.slice());
            });

            return;
        }

        var target = questions[questionIndex];

        // If target is not a question (might be a passage), ignore it
        if (target.question_id === undefined) {
            Ember.run.next(this, function () {
                _self.set('questionIndex', questionIndex + 1);
                _self.tryOneQuestion();
            });
            return;

        }

        var promises = [];
        this.set('promises', promises);
        this.set('trialQuestion', questions[questionIndex]);

        Ember.run.next(this, function () {
            Promise.all(promises).then(function (values) {
                Ember.set(target, '_answerLines_', values[0]);
                _self.set('questionIndex', questionIndex + 1);
                _self.tryOneQuestion();
            });
        });
    },

    onQuestionsChange: Ember.observer('questions.[]', function () {
        var _self = this;
        this.set('questionList', []);
        this.tryAddQuestions();

    }),

    onInit: function () {
        this.set('questionList', []);
    }.on('init'),

    didInsertElement: function () {
        this.tryAddQuestions();
    }
});
