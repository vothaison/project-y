Ember.Controller.extend({
    inAsync: false,
    canSave: false,
    canSaveStatus: '',

    raw: 'Question 43: “How many times have I told you ______ football in the street?” \n' +
    'A. not to play              B. not playing              C. do not play              D. not to have played ',
    output: '',

    parseQuestion: function () {
        var raw = this.get('raw');
        var regexSpaces = / +(?= )/g;

        console.log(raw);

        var lines = raw.split('\n');
        console.log(lines);

        if (lines.length === 2) {
            // First line is the question text, second line -> 4 answers

            var parts = lines[0].split(/:(.+)/);
            var questionText = parts[1];
            if (!questionText) {
                this.set('canSaveStatus', 'Cannot get question text');
            }
            questionText = questionText && questionText.trim();


            parts = lines[1].split(/(A\.)|(B\.)|(C\.)|(D\.)/);
            // should have 5 parts
            if (parts.length !== 5) {
                this.set('canSaveStatus', 'Second line should have 5 parts');
            }

            var answerA = parts[5].trim();
            var answerB = parts[10].trim();
            var answerC = parts[15].trim();
            var answerD = parts[20].trim();

            var question = {
                question_id: 0,
                question_text: questionText,
                choices: [
                    {choice_text: answerA},
                    {choice_text: answerB},
                    {choice_text: answerC},
                    {choice_text: answerD},
                ]
            };
            this.set('currentQuestion', question);

            var output = JSON.stringify(question, null, 4);
            this.set('output', output);
            this.set('canSave', true);
            return question;
        }

        if (lines.length === 3) {
            // First line is the question text,
            // second line -> answer A and B
            // third line -> answer C and D

            var parts = lines[0].split(/:(.+)/);
            var questionText = parts[1].replace(regexSpaces,'');

            if (!questionText) {
                this.set('canSaveStatus', 'Cannot get question text');
            }
            questionText = questionText && questionText.trim();


            parts = lines[1].replace(regexSpaces,'').trim().split(/(A\.)|(B\.)/);
            // should have 4 parts
            if (parts.length !== 4) {
                this.set('canSaveStatus', 'Second line should have 4 parts');
            }

            var answerA = parts[3].trim();
            var answerB = parts[6].trim();

            parts = lines[2].replace(regexSpaces,'').trim().split(/(C\.)|(D\.)/);
            // should have 4 parts
            if (parts.length !== 4) {
                this.set('canSaveStatus', 'Third line should have 4 parts');
            }

            var answerC = parts[3].trim();
            var answerD = parts[4].trim();

            var question = {
                question_id: 0,
                question_text: questionText,
                choices: [
                    {choice_text: answerA},
                    {choice_text: answerB},
                    {choice_text: answerC},
                    {choice_text: answerD},
                ]
            };
            this.set('currentQuestion', question);

            var output = JSON.stringify(question, null, 4);
            this.set('output', output);
            this.set('canSave', true);
            return question;
        }

        if (lines.length === 5) {
            // First line is the question text,
            // second line -> answer A and B
            // third line -> answer C and D

            var parts = lines[0].split(/:(.+)/);
            var questionText = parts[1].replace(regexSpaces,'');

            if (!questionText) {
                this.set('canSaveStatus', 'Cannot get question text');
            }
            questionText = questionText && questionText.trim();


            parts = lines[1].replace(regexSpaces,'').trim().split(/(A\.)/);
            // should have 3 parts
            if (parts.length !== 3) {
                this.set('canSaveStatus', 'Second line should have 3 parts');
            }
            var answerA = parts[2].trim();

            parts = lines[2].replace(regexSpaces,'').trim().split(/(B\.)/);
            // should have 3 parts
            if (parts.length !== 3) {
                this.set('canSaveStatus', 'Second line should have 3 parts');
            }
            var answerB = parts[2].trim();

            parts = lines[3].replace(regexSpaces,'').trim().split(/(C\.)/);
            // should have 4 parts
            if (parts.length !== 3) {
                this.set('canSaveStatus', 'Second line should have 3 parts');
            }
            var answerC = parts[2].trim();

            parts = lines[4].replace(regexSpaces,'').trim().split(/(D\.)/);
            // should have 4 parts
            if (parts.length !== 3) {
                this.set('canSaveStatus', 'Second line should have 3 parts');
            }
            var answerD = parts[2].trim();

            var question = {
                question_id: 0,
                question_text: questionText,
                choices: [
                    {choice_text: answerA},
                    {choice_text: answerB},
                    {choice_text: answerC},
                    {choice_text: answerD},
                ]
            };
            this.set('currentQuestion', question);

            var output = JSON.stringify(question, null, 4);
            this.set('output', output);
            this.set('canSave', true);
            return question;
        }

        this.set('canSave', false);
        this.set('output', '');

    },

    rawChanged: Ember.observer('raw', function () {
        this.parseQuestion();
    }),

    actions: {
        save: function () {
            var currentQuestion = this.get('currentQuestion');
            var postData = {
                data: this.parseQuestion()
            };
            this.set('inAsync', true);

            $.post(Data.SessionData.SaveUrl, postData, function (o) {
                if (o.result === 1) {
                    console.log('OK');

                } else {
                    alert('Nice try. But please try again!')
                }
                this.set('inAsync', false);

            }, 'json').fail(function () {
                alert("error");
                this.set('inAsync', false);

            });
        }
    }
});
