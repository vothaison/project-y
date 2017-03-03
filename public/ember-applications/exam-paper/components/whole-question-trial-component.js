Ember.Component.extend({
    visible: false,
    title: '',
    content: '',
    tagName: 'div',
    classNames: ['whole-question', 'here-not-here'],
    attributeBindings: ['style'],

    didInsertElement: function () {

    },

    fakeOneLineQuestion: {
        question_id: 1,
        question_text: '[SAMPLE] He’s a very ______ person because he can make other workers follow his advice.',
        choices: [
            {
                choice_id: 1,
                choice_text: 'A'
            },
            {
                choice_id: 2,
                choice_text: 'A'
            },
            {
                choice_id: 3,
                choice_text: 'A'
            },
            {
                choice_id: 4,
                choice_text: 'A'
            }
        ]
    },

    fakeZeroLineQuestion: {
        question_id: 1,
        question_text: '',
        choices: [
            {
                choice_id: 1,
                choice_text: 'A'
            },
            {
                choice_id: 2,
                choice_text: 'A'
            },
            {
                choice_id: 3,
                choice_text: 'A'
            },
            {
                choice_id: 4,
                choice_text: 'A'
            }
        ]
    },

    fakeNegativeLineQuestion: {
        question_id: 1,
        question_text: '[A][B][C][D]',
        choices: [
            {
                choice_id: 1,
                choice_text: ''
            },
            {
                choice_id: 2,
                choice_text: ''
            },
            {
                choice_id: 3,
                choice_text: ''
            },
            {
                choice_id: 4,
                choice_text: ''
            }
        ]
    },

    isOneLine: false,
    isTwoLines: false,
    isFourLines: false,
    isZeroLine: false,
    isNegativeLine: false,
    isRewriting: false,

    firstTwo: Ember.computed('displayQuestion.choices.[]', function(){
        var choices = this.get('displayQuestion.choices');
        if(!choices) return [];
      return this.get('displayQuestion.choices').slice(0, 2);
    }),

    lastTwo: Ember.computed('displayQuestion.choices.[]', function(){
        var choices = this.get('displayQuestion.choices');
        if(!choices) return [];
      return this.get('displayQuestion.choices').slice(2, 4);
    }),

    doReset: function () {
        if (!this.isDestroyed) {
            this.set('isOneLine', false);
            this.set('isTwoLines', false);
            this.set('isFourLines', false);
            this.set('isZeroLine', false);
            this.set('isNegativeLine', false);
            this.set('isRewriting', false);

            this.set('displayQuestion', this.get('realQuestion'));
        }
    },

    tryRewriting: function () {
        var _self = this;
        var promise = new Promise(function (resolve, reject) {
            var realQuestion = _self.get('realQuestion');

            if (realQuestion.is_rewriting) {
                resolve(true);
                return;
            }
            resolve(false);
            return;

        });

        return promise;
    },

    tryNegativeLine: function () {
        var _self = this;
        var promise = new Promise(function (resolve, reject) {
            var realQuestion = _self.get('realQuestion');

            if (realQuestion.is_underlined_question) {
                _self.set('isNegativeLine', true);

                _self.set('displayQuestion', _self.get('fakeNegativeLineQuestion'));

                resolve(true);
                return;
            }
            else {
                resolve(false);
                return;
            }


            Ember.run.next(_self, function () {
                var height = _self.$('[role="answer"]').first().height();
                //console.log('height 1', height);

                _self.set('displayQuestion', this.get('realQuestion'));

                Ember.run.next(_self, function () {
                    var tryHeight = _self.$('[role="answer"]').first().height();
                    if (tryHeight == height) {
                        resolve(true);
                    } else {
                        resolve(false);
                    }
                    //console.log('height 2', tryHeight, _self.$('[role="answer"]').length);
                });
            });
        });

        return promise;
    },

    tryZeroLine: function () {
        var _self = this;
        var promise = new Promise(function (resolve, reject) {
            var realQuestion = _self.get('realQuestion');
            if (realQuestion.question_text) {
                resolve(false);
                return;
            }

            if (_self.isDestroyed) {
                //reject('Component is disposed.');
                resolve(false);
                return;
            }
            // Try isZeroLine
            _self.set('isZeroLine', true);
            // Get normal height
            _self.set('displayQuestion', _self.get('fakeZeroLineQuestion'));

            Ember.run.next(_self, function () {
                var height = _self.$('[role="answer"]').first().height();
                //console.log('height 1', height);

                _self.set('displayQuestion', this.get('realQuestion'));
                //console.log(performance.now(), "tryZeroLine.set('displayQuestion', _self.get('realQuestion'))")

                Ember.run.next(_self, function () {
                    var tryHeight = _self.$('[role="answer"]').first().height();
                    if (tryHeight == height) {
                        resolve(true);
                    } else {
                        resolve(false);
                    }
                    //console.log('height 2', tryHeight, _self.$('[role="answer"]').length);
                });
            });
        });

        return promise;
    },

    tryOneLine: function () {
        var _self = this;
        //console.log(performance.now(), 'start process question', this.get('realQuestion').question_id);
        var promise = new Promise(function (resolve, reject) {
            if (_self.isDestroyed) {
                //reject('Component is disposed.');
                return;
            }
            // Try isOneLine
            _self.set('isOneLine', true);
            // Get normal height
            //console.log(performance.now(), ".set('displayQuestion', _self.get('fakeOneLineQuestion'))")
            _self.set('displayQuestion', _self.get('fakeOneLineQuestion'));

            Ember.run.next(_self, function () {
                //console.log(performance.now(), 'with fake oneline question', _self.$().html());
                var height = _self.$('[role="answer"]').first().height();
                var heightTag = _self.$('[role="answer"]').first()[0];

                //console.log(performance.now(), "tryOneLine.set('displayQuestion', _self.get('realQuestion'))")
                _self.set('displayQuestion', this.get('realQuestion'));

                Ember.run.next(_self, function () {
                    //console.log(performance.now(), 'with REAL         question', _self.$().html());
                    var tryHeight = _self.$('[role="answer"]').first().height();
                    var tryHeightTag = _self.$('[role="answer"]').first()[0];

                    //console.log(performance.now(), 'question ', this.get('realQuestion').question_id, tryHeight, height, );
                    if (tryHeight == height) {
                        resolve(true);
                    } else {
                        resolve(false);
                    }
                    //console.log('height 2', tryHeight, _self.$('[role="answer"]').length);
                });
            });
        });

        return promise;
    },

    tryTwoLines: function () {
        var _self = this;

        var promise = new Promise(function (resolve, reject) {
            if (_self.isDestroyed) {
                //reject('Component is disposed.');
                return;
            }

            // Try isOneLine
            _self.set('isTwoLines', true);

            // Get normal height
            _self.set('displayQuestion', _self.get('fakeOneLineQuestion'));

            Ember.run.next(_self, function () {
                var firstHeight = _self.$('[role="answer"]').first().height();
                var thirdHeight = _self.$('[role="answer"]').third().height();

                //console.log('height 1', firstHeight, firstHeight);

                _self.set('displayQuestion', this.get('realQuestion'));
                //console.log(performance.now(), "tryTwoLines.set('displayQuestion', _self.get('realQuestion'))")

                Ember.run.next(_self, function () {
                    var tryFirstHeight = _self.$('[role="answer"]').first().height();
                    var tryThirdHeight = _self.$('[role="answer"]').third().height();
                    if (tryFirstHeight == firstHeight && tryThirdHeight == thirdHeight) {
                        resolve(true);
                    } else {
                        resolve(false);
                    }
                    //console.log('height 2', tryHeight);
                });
            });
        });

        return promise;
    },

    tryFourLines: function () {
        var _self = this;

        var promise = new Promise(function (resolve, reject) {
            // Try isOneLine
            _self.set('isFourLines', true);
            resolve(true);
        });
        return promise;
    },

    methods: [
        {lines: -2, name: 'tryRewriting' },
        {lines: -1, name: 'tryNegativeLine'},
        {lines: 0, name: 'tryZeroLine'  },
        {lines: 1, name: 'tryOneLine'  },
        {lines: 2, name: 'tryTwoLines'  },
        {lines: 4, name: 'tryFourLines'  },
    ],

    tryMethod: function(question, methodIndex, resolve) {
        var _self = this;
        var methods = this.get('methods');

        if(methodIndex < methods.length) {
            var method = methods[methodIndex];
            var methodName = method.name;
            var lines = method.lines;

            _self[methodName]().then(function(ok) {
                    if (!ok) {
                        _self.doReset();
                        _self.tryMethod(question, methodIndex + 1, resolve);
                    } else {
                        _self.set('lines', lines);
                        //console.log('resolve question', question.question_id, lines)
                        Ember.set(question, '_lines_', lines);
                        resolve(lines);
                    }
            });
        }
    },

    questionObserver: Ember.observer('question', function () {
        var _self = this;
        var question = this.get('question');
        var promises = this.get('promises');

        if (!question) {
            Ember.run.later(this, function () {
                this.set('style', Ember.String.htmlSafe('display: none;'))
            });
            return;
        } else {
            this.set('style', Ember.String.htmlSafe(''));
        }

        var promise = new Promise(function (resolve, reject) {
            _self.set('realQuestion', question);
            _self.tryMethod(question, 0, resolve);
        });
        promises.push(promise);
    }),

    actions: {}
});
