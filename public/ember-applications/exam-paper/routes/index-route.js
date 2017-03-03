Ember.Route.extend({
    model: function () {
        var model = {

            questions: [

              {
                  text_id: 0,
                  requirement: 'Mark the letter A, B, C, or D on your answer  sheet to indicate the underlined part that needs correction in each of the following questions'
              },

                {
                    question_id: 2,
                    is_underlined_question: true,
                    question_text: '[Since] January [this year], Joe has suffered two [injuries], one to his ankle and the other [in New York.] ',
                },
                {
                    question_id: 2,
                    is_underlined_question: true,
                    question_text: 'Women in many [parts] of the world have had lower status than men, [which] the extent of [the gap between genders] [varies] across cultures and times. ',
                },
                {
                    question_id: 2,
                    is_underlined_question: true,
                    question_text: '[As seeing] [from] the mountain top, the area looks [like] a [picturesque harbour town.]',
                },
                {
                    question_id: 2,
                    is_underlined_question: true,
                    question_text: '[All of the students] in this course will be assessed [according to] their attendance, [performance], and [they work hard].  ',
                },
                {
                    question_id: 2,
                    is_underlined_question: true,
                    question_text: '[Most of] the students [are] queuing [in lines] waiting [to enter] the classroom. ',
                },
                {
                    question_id: 2,
                    question_text: 'The early failure of the Spanish squad in the 2014 World Cup deeply disappointed their fans. ',
                    choices: [
                        {choice_text: ' Living up to their fans’ expectation, the Spanish squad left the 2014 World Cup so early.'},
                        {choice_text: ' The Spanish squad was terribly disappointed that their fans had to leave the 2014 World Cup so early.'},
                        {choice_text: 'That their squad left the 2014 World Cup so early was very disappointing for the Spanish sportsmen.'},
                        {choice_text: ' To the disappointment of their fans, the Spanish squad had to leave the 2014 World Cup too early. '},
                    ]
                },

                {
                    question_id: 2,
                    question_text: 'The writer mentions the Internet in the passage as ______. ',
                    choices: [
                        {
                            choice_id: 1,
                            choice_text: ' an easy solution to sleep deprivation '
                        },
                        {
                            choice_id: 2,
                            choice_text: ' a temptation that prevents us from sleeping'
                        },
                        {
                            choice_id: 3,
                            choice_text: 'a factor that is not related to sleep deprivation '
                        },
                        {
                            choice_id: 4,
                            choice_text: ' an ineffective means of communication'
                        }
                    ]
                },

                {
                    question_id: 1,
                    question_text: 'He’s a very ______ person because he can make other workers follow his advice.',
                    question_text: '',
                    choices: [
                        {
                            choice_id: 1,
                            choice_text: 'creative'
                        },
                        {
                            choice_id: 2,
                            choice_text: 'influential'
                        },
                        {
                            choice_id: 3,
                            choice_text: 'deciding'
                        },
                        {
                            choice_id: 4,
                            choice_text: 'effective'
                        }
                    ]
                },

                {
                    text_id: 0,
                    requirement: 'Finish each of the following sentences in such a way that it means the same as the sentence printed before it. '
                },

                {
                    question_id: 2,
                    is_rewriting: true,
                    question_text: '“I ‘m sorry that I broke the glass,” the boy said.',
                    answer_starter: 'The boy apologized ',
                },

                {
                    question_id: 2,
                    is_rewriting: true,
                    question_text: 'Reading scientific books is one of my interests.',
                    answer_starter: 'I am',
                },

                {
                    question_id: 2,
                    is_rewriting: true,
                    question_text: 'If John does not change his working style, he will be sacked soon. ',
                    answer_starter: 'Unless',
                },

                {
                    text_id: 0,
                    requirement: 'Read the following passage and mark the letter A, B, C, or D on your answer sheet to indicate the correct answer to each of the questions from 11 to 20.',
                    text_content: '' +
                    '<p>Probably the most famous film commenting on the twentieth-century technology is Modern Times, made in 1936. Charlie Chaplin was motivated to make the film by a reporter who, while interviewing him, happened to describe the working conditions in industrial Detroit. Chaplin was told that healthy young farm boys were lured to the city to work on automotive assembly lines. Within four or five years, these young men’s health was destroyed by the stress of work in the factories. </p>' +
                    '<p>The film opens with a shot of a mass of sheep making their way down a crowded ramp.             Abruptly, the film shifts to a scene of factory workers  jostling one another on their way to a         factory. However, the rather bitter note of criticism  in the implied comparison is not sustained. It is         replaced by a gentle note of satire. Chaplin prefers to entertain rather than lecture.             Scenes of factory interiors account for only about one-third of Modern Times, but they contain some of the most pointed social commentary as well as the most comic situations.</p>'
                },

                {
                    question_id: 2,
                    question_text: 'In no circumstances ______ on campus.',
                    choices: [
                        {
                            choice_id: 1,
                            choice_text: 'should allow smoking'
                        },
                        {
                            choice_id: 2,
                            choice_text: 'we should allow smoking'
                        },
                        {
                            choice_id: 3,
                            choice_text: 'should smoking be allowed'
                        },
                        {
                            choice_id: 4,
                            choice_text: 'smoking should be allowed'
                        }
                    ]
                },

                {
                    question_id: 2,
                    question_text: 'Which of the following is TRUE, according to the last paragraph?',
                    choices: [
                        {
                            choice_id: 1,
                            choice_text: 'Doctors ‘on night call’ do not need more than three hours of sleep a day.'
                        },
                        {
                            choice_id: 2,
                            choice_text: 'Sleep deprivation has negative effects on both individuals and society. '
                        },
                        {
                            choice_id: 3,
                            choice_text: 'Thousands of people are killed every day by drunken drivers. '
                        },
                        {
                            choice_id: 4,
                            choice_text: 'Our motivation decreases with the bigger number of hours we sleep.'
                        }
                    ]
                },

                {
                    question_id: 2,
                    question_text: ' According to the passage, which of the following statements is TRUE about Paul Martin? ',
                    choices: [
                        {
                            choice_id: 1,
                            choice_text: 'He describes the modern world as a place without insomnia. '
                        },
                        {
                            choice_id: 2,
                            choice_text: ' He gives an interesting account of a sleepless society.'
                        },
                        {
                            choice_id: 3,
                            choice_text: ' He is a scientist who is chronically deprived of sleep. '
                        },
                        {
                            choice_id: 4,
                            choice_text: ' He shows his concern for sleep deprivation in modern society. '
                        }
                    ]
                },



                {
                    text_id: 0,
                    requirement: 'Mark the letter A, B, C, or D on your answer sheet to indicate the word that differs from the rest in the position of the main stress in each of the following questions'
                },

                {
                    question_id: 2,
                    question_text: '',
                    choices: [
                        {choice_text: 'catastrophe'},
                        {choice_text: 'supervisor'},
                        {choice_text: 'agriculture'},
                        {choice_text: 'dictionary'},
                    ]
                },

                {
                    question_id: 2,
                    question_text: '',
                    choices: [
                        {choice_text: 'which'},
                        {choice_text: 'what'},
                        {choice_text: 'whether'},
                        {choice_text: 'which'},
                    ]
                },

                {
                    question_id: 2,
                    question_text: '',
                    choices: [
                        {choice_text: 'underneath'},
                        {choice_text: 'down'},
                        {choice_text: 'below'},
                        {choice_text: 'into'},
                    ]
                },

                {
                    question_id: 2,
                    question_text: '',
                    choices: [
                        {choice_text: 'implanting'},
                        {choice_text: 'transplanting'},
                        {choice_text: 'growing'},
                        {choice_text: 'cultivating'},
                    ]
                },

                {
                    question_id: 2,
                    question_text: ' The phrase “round the clock” in the second paragraph is similar in meaning to ______. ',
                    choices: [
                        {
                            choice_id: 1,
                            choice_text: 'surrounded with clocks'
                        },
                        {
                            choice_id: 2,
                            choice_text: 'having a round clock '
                        },
                        {
                            choice_id: 3,
                            choice_text: ' all day and night'
                        },
                        {
                            choice_id: 4,
                            choice_text: ' during the daytime '
                        }
                    ]
                },


                {
                    question_id: 2,
                    question_text: ' The word “which” in the third paragraph refers to ______.',
                    choices: [
                        {
                            choice_id: 1,
                            choice_text: 'masking the symptoms '
                        },
                        {
                            choice_id: 2,
                            choice_text: 'reaching a point '
                        },
                        {
                            choice_id: 3,
                            choice_text: ' caffeine consumption'
                        },
                        {
                            choice_id: 4,
                            choice_text: ' the world\'s population '
                        }
                    ]
                },


                {
                    question_id: 2,
                    question_text: ' Which of the following is TRUE, according to the last paragraph? ',
                    choices: [
                        {
                            choice_id: 1,
                            choice_text: ' Doctors ‘on night call’ do not need more than three hours of sleep a day.'
                        },
                        {
                            choice_id: 2,
                            choice_text: 'Sleep deprivation has negative effects on both individuals and society. '
                        },
                        {
                            choice_id: 3,
                            choice_text: ' Thousands of people are killed every day by drunken drivers.'
                        },
                        {
                            choice_id: 4,
                            choice_text: ' Our motivation decreases with the bigger number of hours we sleep.'
                        }
                    ]
                },

                {
                    question_id: 2,
                    question_text: 'The word “catastrophic” in the last paragraph probably means ______.',
                    choices: [
                        {
                            choice_id: 1,
                            choice_text: 'likely to become worthless '
                        },
                        {
                            choice_id: 2,
                            choice_text: ' causing serious damage or loss'
                        },
                        {
                            choice_id: 3,
                            choice_text: ' bound to bring satisfaction'
                        },
                        {
                            choice_id: 4,
                            choice_text: 'becoming more noticeable '
                        }
                    ]
                },

                {
                    question_id: 10,
                    question_text: ' Which of the following would the writer of the passage approve of? ',
                    choices: [
                        {
                            choice_id: 1,
                            choice_text: 'Both drunken drivers and sleep-deprived people should be criticized. '
                        },
                        {
                            choice_id: 2,
                            choice_text: 'We certainly can function well even when we hardly sleep.'
                        },
                        {
                            choice_id: 3,
                            choice_text: ' There is no point in criticizing irresponsible people in our society. '
                        },
                        {
                            choice_id: 4,
                            choice_text: 'Our world would be a much safer place without drinkers. '
                        }
                    ]
                },

                {
                    question_id: 2,
                    question_text: ' All of the following are mentioned as those whose performance is affected by ‘sleep debt’ EXCEPT ______. ',
                    choices: [
                        {
                            choice_id: 1,
                            choice_text: 'biologists'
                        },
                        {
                            choice_id: 2,
                            choice_text: 'drivers'
                        },
                        {
                            choice_id: 3,
                            choice_text: 'doctors'
                        },
                        {
                            choice_id: 4,
                            choice_text: 'engineers'
                        }
                    ]
                },

                {
                    question_id: 2,
                    question_text: 'Which of the following could best serve as the title of the passage? ',
                    choices: [
                        {
                            choice_id: 1,
                            choice_text: ' Sleep Deprivation: Causes and Effects '
                        },
                        {
                            choice_id: 2,
                            choice_text: ' A Society of Sleepless People '
                        },
                        {
                            choice_id: 3,
                            choice_text: ' A Well-known Biologis'
                        },
                        {
                            choice_id: 4,
                            choice_text: ' Accident Prevention: Urgent! '
                        }
                    ]
                },

                {
                    question_id: 2,
                    question_text: '“Send this urgent document immediately!” the officer told the soldier. ',
                    choices: [
                        {choice_text: ' The officer ordered the soldier to deliver the urgent document instantly.'},
                        {choice_text: ' The officer advised the soldier to send the urgent document right away. '},
                        {choice_text: ' The officer requested that the soldier rush out due to the document’s urgency.'},
                        {choice_text: ' The officer recommended the soldier leave right away because of the urgent document.'},
                    ]
                },

                {
                    question_id: 2,
                    question_text: 'The president placed his car at my disposal as a bonus for my good work. ',
                    choices: [
                        {choice_text: ' To get rid of the car, the president decided to sell it to me, his good worker, at a bonus price. '},
                        {choice_text: ' I was willing to drive the president’s car as a compliment for my good performance at work. '},
                        {choice_text: ' In order to praise me as a good worker, the president took me home in his own car.'},
                        {choice_text: ' To show his appreciation for my good work, the president allowed me to use his car whenever I liked.'},
                    ]
                },

                {
                    question_id: 2,
                    question_text: '“Why don\'t you join us for our next class reunion?” Mary said to me. ',
                    choices: [
                        {choice_text: ' Mary strongly urged me to join them for the next class reunion'},
                        {choice_text: ' Mary advised me not to join them for the next class reunion.'},
                        {choice_text: ' Mary cordially invited me to join them for the next class reunion. '},
                        {choice_text: ' Mary insisted on my joining them for the next class reunion. '},
                    ]
                },

                {
                    question_id: 2,
                    question_text: '“Believe me. It’s no use reading that book,” Janet told her boyfriend. ',
                    choices: [
                        {choice_text: ' Janet suggested to her boyfriend that reading the book was useful.'},
                        {choice_text: ' Janet managed to persuade her boyfriend that reading the book was worthwhile. '},
                        {choice_text: ' Janet tried to convince her boyfriend that the book was not worth reading. '},
                        {choice_text: ' Janet opposed her boyfriend’s idea that reading the book was not useful. '},
                    ]
                },

                {
                    question_id: 2,
                    question_text: 'The early failure of the Spanish squad in the 2014 World Cup deeply disappointed their fans. ',
                    choices: [
                        {choice_text: ' Living up to their fans’ expectation, the Spanish squad left the 2014 World Cup so early.'},
                        {choice_text: ' The Spanish squad was terribly disappointed that their fans had to leave the 2014 World Cup so early.'},
                        {choice_text: 'That their squad left the 2014 World Cup so early was very disappointing for the Spanish sportsmen.'},
                        {choice_text: ' To the disappointment of their fans, the Spanish squad had to leave the 2014 World Cup too early. '},
                    ]
                },

                {
                    question_id: 2,
                    question_text: 'He talked about nothing except the weather.',
                    choices: [
                        {choice_text: ' He talked about everything including the weather.'},
                        {choice_text: ' He had nothing to say about the weather.'},
                        {choice_text: ' His sole topic of conversation was the weather. '},
                        {choice_text: 'He said that he had no interest in the weather. '},
                    ]
                },

                {
                    question_id: 2,
                    question_text: 'Peter had very little money but managed to make ends meet.',
                    choices: [
                        {choice_text: 'Having little money, Peter couldn’t make ends meet. '},
                        {choice_text: 'Peter got by on very little money. '},
                        {choice_text: 'Peter could hardly live on little money. '},
                        {choice_text: 'Peter found it hard to live on very little money. '},
                    ]
                },
                {
                    question_id: 2,
                    question_text: 'The film didn’t come up to my expectations. ',
                    choices: [
                        {choice_text: ' I expected the film to be more boring.'},
                        {choice_text: 'The film was as good as I expected. '},
                        {choice_text: ' I expected the film to end more abruptly. '},
                        {choice_text: 'The film fell short of my expectations. '},
                    ]
                },
                {
                    question_id: 2,
                    question_text: 'It doesn’t matter to them which film they go to. ',
                    choices: [
                        {choice_text: 'Whatever films are shown, they never see.'},
                        {choice_text: ' They don’t mind which film they go to.'},
                        {choice_text: ' Which film they go to matters more than the cost. '},
                        {choice_text: 'They don’t care about the cost of the films they see.'},
                    ]
                },
                {
                    question_id: 2,
                    question_text: 'He survived the operation thanks to the skilful surgeon. ',
                    choices: [
                        {choice_text: 'There was no skilful surgeon, so he died.'},
                        {choice_text: ' He survived because he was a skilful surgeon. '},
                        {choice_text: 'He wouldn’t have survived the operation without the skilful surgeon. '},
                        {choice_text: 'Though the surgeon was skilful, he couldn’t survive the operation.'},
                    ]
                },
                {
                    question_id: 2,
                    question_text: 'James was the last to know about the change of schedule.',
                    choices: [
                        {choice_text: 'The last thing James knew was the change of schedule. '},
                        {choice_text: ' Among the last people informed of the change of schedule was James.'},
                        {choice_text: 'At last James was able to know about the change of schedule.'},
                        {choice_text: 'Everyone had heard about the change of schedule before James did. '},
                    ]
                },

                {
                    question_id: 2,
                    question_text: 'There’s no point in persuading Jane to change her mind. ',
                    choices: [
                        {choice_text: ' No one wants Jane to change her mind because it’s pointless. '},
                        {choice_text: ' Jane will change her mind though she doesn’t want to. '},
                        {choice_text: 'It’s possible for us to persuade Jane to change her mind. '},
                        {choice_text: 'It’s useless to persuade Jane to change her mind'},
                    ]
                },
                {
                    question_id: 2,
                    question_text: ' She said, “John, I’ll show you round my city when you’re here.” ',
                    choices: [
                        {choice_text: 'She planned to show John round her city. '},
                        {choice_text: 'She organized a trip round her city for John.'},
                        {choice_text: ' She promised to show John round her city.'},
                        {choice_text: ' She made a trip round her city with John. '},
                    ]
                },
                {
                    question_id: 2,
                    question_text: '“Please don’t drive so fast, Tom,” said Lisa. ',
                    choices: [
                        {choice_text: 'Lisa pleaded with Tom not to drive too fast.'},
                        {choice_text: ' Lisa grumbled to Tom about driving slowly. '},
                        {choice_text: 'Lisa insisted on Tom’s driving on. '},
                        {choice_text: 'Lisa complained about Tom’s driving too fast. '},
                    ]
                },
                {
                    question_id: 2,
                    question_text: '“Why don’t you reply to the President’s offer right now?” said Mary to her husband.',
                    choices: [
                        {choice_text: 'Mary wondered why her husband didn’t reply to the President’s offer then.'},
                        {choice_text: ' Mary suggested that her husband should reply to the President’s offer without delay'},
                        {choice_text: 'Mary told her husband why he didn’t reply to the President’s offer then.'},
                        {choice_text: 'Mary ordered her husband to reply to the President’s offer right now'},
                    ]
                },
                {
                    question_id: 2,
                    question_text: 'The kitchen ______ dirty because she has just cleaned it. ',
                    choices: [
                        {choice_text: ' mustn’t be'},
                        {choice_text: ' may be'},
                        {choice_text: ' can’t be'},
                        {choice_text: ' should be '},
                    ]
                },

                {
                    question_id: 2,
                    question_text: 'The word “domestication” in the first paragraph mostly means ______.',
                    choices: [
                        {choice_text: ' adapting animals to suit a new working environment'},
                        {choice_text: ' making wild animals used to living with and working for humans '},
                        {choice_text: ' hatching and raising new species of wild animals in the home '},
                        {choice_text: ' teaching animals to do a particular job or activity in the home '},
                    ]
                },
                {
                    question_id: 2,
                    question_text: 'According to the passage, subsistence societies depend mainly on ______. ',
                    choices: [
                        {choice_text: 'agricultural products'},
                        {choice_text: 'farming methods '},
                        {choice_text: 'hunter-gatherers’ tools '},
                        {choice_text: 'nature’s provision'},
                    ]
                },
                {
                    question_id: 2,
                    question_text: 'The word “marginal” in the second paragraph is closest in meaning to “______”.',
                    choices: [
                        {choice_text: 'suburban'},
                        {choice_text: 'disadvantaged'},
                        {choice_text: 'abandoned'},
                        {choice_text: 'forgotten'},
                    ]
                },
                {
                    question_id: 2,
                    question_text: 'In the lower latitudes of the tropics, hunter-gatherers ______.',
                    choices: [
                        {choice_text: ' can free themselves from hunting'},
                        {choice_text: ' have better food gathering from nature '},
                        {choice_text: ' harvest shorter seasonal crops '},
                        {choice_text: ' live along the coasts and waterways for fishing'},
                    ]
                },
            ],

            _questions: [
              {
                  question_id: 2,
                  is_underlined_question: true,
                  question_text: 'Bill was [about average] in performance [in] comparison [with other students] in [his] class.',
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
            ]
        };
        var question_id = 1;

        model.questions
            //.filter(function(item){
            //    return item.question_id;
            //})
            .forEach(function (item, i) {
                if (item.question_id !== undefined) {
                    item.question_id = question_id;
                    question_id++;
                }
            });

        //model.questions = model.questions.slice(0, 3);
        return model;
    },

    _0_: {
        question_id: 2,
        question_text: '',
        choices: [
            {choice_text: ''},
            {choice_text: ''},
            {choice_text: ''},
            {choice_text: ''},
        ]
    },

    setupController: function (controller, model) {
        this._super(controller, model);
        // Set the IndexController's `title`
        controller.set('title', 'Exam Paper');
    }
});
