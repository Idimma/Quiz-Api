<?php

namespace App\database\migrations;

use DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('question')->nullable();
            $table->string('a')->nullable();
            $table->string('b')->nullable();
            $table->string('c')->nullable();
            $table->string('d')->nullable();
            $table->string('e')->nullable();
            $table->string('answer')->nullable();
            $table->string('class')->nullable();
            $table->string('type')->nullable();
            $table->text('meta')->nullable();
            $table->timestamps();
        });


        $data = [
            ['type' => 'draw1', 'question' => 'The point where the x and y axes meet in a graph is called:', 'a' => 'Cartesian', 'b' => 'Intersection', 'c' => 'Plane', 'd' => 'Origin', 'answer' => 'd'],
            ['type' => 'draw1', 'question' => 'Choose the option nearest in meaning to the underlined word.\n\nHer problem was exacerbated by the loss of her father.', 'a' => 'exaggerated', 'b' => 'solved', 'c' => 'aggravated', 'd' => 'infuriated', 'answer' => 'C'],
            ['type' => 'draw1', 'question' => 'What sum of money will amount to D10,400 in 5 years at 6% simple interest?', 'a' => 'D8,000.00', 'b' => 'D10,000.00', 'c' => 'D12,000.00', 'd' => 'D16,000.00', 'answer' => 'B'],
            [
                'type' => 'draw2',
                'question' => 'Choose the word that is opposite in meaning to the underlined word. The warring communities were *coerced* into negotiating a settlement.',
                'a' => 'driven',
                'b' => 'compelled',
                'c' => 'persuaded',
                'd' => 'pressured',
                'answer' => 'C'
            ],
            [
                'type' => 'draw2',
                'question' => 'The sum of two numbers is twice their difference. If the difference of the numbers is p, find the larger of the two numbers.',
                'a' => 'p/2',
                'b' => '3p/2',
                'c' => '5p/2',
                'd' => '3p',
                'answer' => 'B'
            ],
            [
                'type' => 'draw2',
                'question' => 'Choose the option nearest in meaning to the underlined word. Since its *inception* in 1983, the newspaper has attracted thousands of readers.',
                'a' => 'renaissance',
                'b' => 'coming',
                'c' => 'commencement',
                'd' => 'publication',
                'answer' => 'C'
            ],
            [
                'type' => 'draw3',
                'question' => '5/12 of all the students are girls and 1/4 of all the students are girls who take Spanish. What fraction of the girls speak Spanish?',
                'a' => '5/48',
                'b' => '3/7',
                'c' => '2/5',
                'd' => '3/5',
                'answer' => 'D'
            ],
            [
                'type' => 'draw3',
                'question' => 'Complete this sentence by choosing the option that most suitably fills the space: For _______ he is a secretary we shall not have correct minutes',
                'a' => 'because',
                'b' => 'as long as',
                'c' => 'so long',
                'd' => 'in as much',
                'answer' => 'B'
            ],
            [
                'type' => 'draw3',
                'question' => 'What value of k makes the given expression a perfect square ? M² - 8m + k = 0',
                'a' => '4',
                'b' => '8',
                'c' => '16',
                'd' => '64',
                'answer' => 'C'
            ],
            [
                'type' => 'draw3',
                'question' => 'Choose the option that best conveys the meaning of the underlined portion in the following sentence: The balance sheet at the end of the business year shows that we *broke even*',
                'a' => 'lost heavily',
                'b' => 'made profit',
                'c' => 'were heavily indebted to our bankers',
                'd' => 'neither lost nor gained',
                'answer' => 'D'
            ],
            [
                'type' => 'draw3',
                'question' => 'If 3logₐ + 5logₐ - 6logₐ = log64, what is a?',
                'a' => '4',
                'b' => '8',
                'c' => '16',
                'd' => '32',
                'answer' => 'B'
            ],
            [
                'type' => 'draw3',
                'question' => 'In the question below, fill the gap with the appropriate option: I have stopped writing letters of application because I _________ that all the vacancies are filled',
                'a' => 'have heard',
                'b' => 'had heard',
                'c' => 'heard',
                'd' => 'hear',
                'answer' => 'C'
            ]
            ,
            [
                'type' => 'stage1',
                'question' => 'A trader bought 100 oranges at 5 for N40.00 and sold 20 for N120.00. Find the profit or loss percent?',
                'a' => '20% profit',
                'b' => '20% loss',
                'c' => '25% profit',
                'd' => '25% loss',
                'answer' => 'D'
            ],
            [
                'type' => 'stage1',
                'question' => 'Choose the option that best completes the gap. Ife asked me __________',
                'a' => 'what time it was',
                'b' => 'what is it by my time',
                'c' => 'what time is it',
                'd' => 'what time it is',
                'answer' => 'A'
            ],
            [
                'type' => 'stage1',
                'question' => 'The circular diagram in which all the elements have angular representations is called',
                'a' => 'bar chart',
                'b' => 'pie chart',
                'c' => 'pictogram',
                'd' => 'histogram',
                'answer' => 'B'
            ],
            [
                'type' => 'stage1',
                'question' => 'Choose the option that best completes the gap. Lami\'s father ........ as a gardener when he was young, but now he is a driver.',
                'a' => 'had been working',
                'b' => 'use to work',
                'c' => 'has worked',
                'd' => 'used to work',
                'answer' => 'D'
            ],
            [
                'type' => 'stage1',
                'question' => 'Solve for x in 3(x+2) = 2(x+2).',
                'a' => '-4',
                'b' => '-2',
                'c' => '2',
                'd' => '4',
                'answer' => 'B'
            ],
            [
                'type' => 'stage1',
                'question' => 'In the question below choose the option opposite in meaning to the word underlined: Ojo\'s response *infuriated* his wife',
                'a' => 'annoyed',
                'b' => 'pleased',
                'c' => 'surprised',
                'd' => 'confused',
                'answer' => 'B'
            ],
            [
                'type' => 'stage1',
                'question' => 'The following are polygons except:',
                'a' => 'triangle',
                'b' => 'quadrilateral',
                'c' => 'heptagon',
                'd' => 'circle',
                'answer' => 'D'
            ],
            [
                'type' => 'stage1',
                'question' => 'Choose the option which is nearest in meaning to the sentence: We visited the home of one boy. That\'s the boy I mean.',
                'a' => 'That\'s the boy whom we visited his home',
                'b' => 'That\'s the boy whose home we visited',
                'c' => 'That\'s the boy to whose home we visited',
                'd' => 'That\'s the boy the home of whom we visited',
                'answer' => 'B'
            ],
            [
                'type' => 'stage1',
                'question' => 'The marks of eight students in a test are: 3, 10, 4, 5, 14, 13, 16 and 7. Find the range',
                'a' => '16',
                'b' => '14',
                'c' => '13',
                'd' => '11',
                'answer' => 'C'
            ],
            [
                'type' => 'stage1',
                'question' => 'Choose the option that best completes the gap. When his car tyre ......... on the way, he did not know what to do.',
                'a' => 'has burst',
                'b' => 'had burst',
                'c' => 'bursted',
                'd' => 'burst',
                'answer' => 'D'
            ],
            [
                'type' => 'stage1',
                'question' => 'Express 1975 correct to 2 significant figures',
                'a' => '20',
                'b' => '1,900',
                'c' => '1,980',
                'd' => '2,000',
                'answer' => 'D'
            ],
            [
                'type' => 'stage1',
                'question' => 'Choose the option that best completes the gap. I wonder how he will ......being absent from school for a long time.',
                'a' => 'make in',
                'b' => 'make up',
                'c' => 'make off',
                'd' => 'make out',
                'answer' => 'B'
            ],
            [
                'type' => 'stage1',
                'question' => 'What is the probability of having an odd number in a single toss of a fair die?',
                'a' => '1/6',
                'b' => '1/3',
                'c' => '1/2',
                'd' => '2/3',
                'answer' => 'C'
            ],
            [
                'type' => 'stage1',
                'question' => 'Choose the expression or word which best completes each sentence: They went to the market and bought a suitcase and .... bag',
                'a' => 'a big leather brown',
                'b' => 'a big brown leather',
                'c' => 'a brown big leather',
                'd' => 'a leather big brown',
                'answer' => 'B'
            ],
            [
                'type' => 'stage1',
                'question' => 'Which of these is not a prime number?',
                'a' => '41',
                'b' => '43',
                'c' => '47',
                'd' => '49',
                'answer' => 'D'
            ]
            ,


            [
                'type' => 'stage2',
                'question' => 'Choose the option that best conveys the meaning of the underlined portion in the following sentence; In the match against the uplanders team, the sub mariners turned out to be the dark horse',
                'a' => 'played most brilliantly',
                'b' => 'played below their usual form',
                'c' => 'won unexpectedly',
                'd' => 'lost as expected',
                'answer' => 'C'
            ],
            [
                'type' => 'stage2',
                'question' => 'Halima is n years old. Her brother\'s age is 5 years more than half of her age. How old is her brother?',
                'a' => 'n/2 + 5/2',
                'b' => 'n/2 - 5',
                'c' => '5 - n/2',
                'd' => 'n/2 + 5',
                'answer' => 'D'
            ],
            [
                'type' => 'stage2',
                'question' => 'Choose the option that most appropriately completes the sentence; The Lagos Trade Fair________ annually.',
                'a' => 'are held',
                'b' => 'is held',
                'c' => 'is holding',
                'd' => 'may be holding',
                'answer' => 'B'
            ],
            [
                'type' => 'stage2',
                'question' => 'If 2 times a certain integer is subtracted from five times the integer, the result is 63. Find the integer.',
                'a' => '21',
                'b' => '9',
                'c' => '7',
                'd' => '3',
                'answer' => 'A'
            ],
            [
                'type' => 'stage2',
                'question' => 'Choose the option that best conveys the meaning of the underlined portion in the following sentence; Only the small fry get punished for such social misdemeanours',
                'a' => 'small boys',
                'b' => 'unimportant people',
                'c' => 'frightened people',
                'd' => 'frivolous people',
                'answer' => 'B'
            ],
            [
                'type' => 'stage2',
                'question' => 'A sales girl gave a change of N1.15 to a customer instead of N1.25. Calculate her percentage error',
                'a' => '2.40%',
                'b' => '8.00%',
                'c' => '7%',
                'd' => '10%',
                'answer' => 'B'
            ],
            [
                'type' => 'stage2',
                'question' => 'Choose the option that best completes the gap. Audu took these actions purely ...... his own career.',
                'a' => 'on furtherance of',
                'b' => 'in furtherance of',
                'c' => 'to furtherance in',
                'd' => 'in furtherance with',
                'answer' => 'B'
            ],
            [
                'type' => 'stage2',
                'question' => 'Points P and Q are respectively 24m north and 7m east of point R',
                'a' => '20',
                'b' => '24',
                'c' => '25',
                'd' => '31',
                'answer' => 'C'
            ],
            [
                'type' => 'stage2',
                'question' => 'Choose the word that is opposite in meaning to the underlined word. "I do not trust him", he said, in a rare moment of candour?',
                'a' => 'reproach',
                'b' => 'dishonesty',
                'c' => 'frankness',
                'd' => 'fairness',
                'answer' => 'B'
            ],
            [
                'type' => 'stage2',
                'question' => 'a is inversely proportional to b. If a = 16 when b = 1, what is b when a = 8?',
                'a' => '4',
                'b' => '2',
                'c' => '0.5',
                'd' => '-2',
                'answer' => 'B'
            ],
            [
                'type' => 'stage2',
                'question' => 'Choose the expression or word which best complete each sentence: There were so many children ....',
                'a' => 'that she couldn\'t feed them all',
                'b' => 'that she couldn\'t feed',
                'c' => 'than she could feed',
                'd' => 'more than she could feed them all',
                'answer' => 'A'
            ],
            [
                'type' => 'stage2',
                'question' => 'Which of these is not associated with a circle?',
                'a' => 'diagonal',
                'b' => 'tangent',
                'c' => 'segment',
                'd' => 'arc',
                'answer' => 'A'
            ],
            [
                'type' => 'stage2',
                'question' => 'Complete this sentence by choosing the option that most suitably fills the space; Isn\'t it high time you .... your office?',
                'a' => 'are leaving',
                'b' => 'do leave',
                'c' => 'left',
                'd' => 'did leave',
                'answer' => 'C'
            ],
            [
                'type' => 'stage2',
                'question' => 'On a map, 1cm represents 5km. Find the area on the map that represents 100km?',
                'a' => '2cm²',
                'b' => '4cm²',
                'c' => '8cm²',
                'd' => '20cm²',
                'answer' => 'B'
            ],
            [
                'type' => 'stage2',
                'question' => 'Choose the interpretation that you consider most appropriate for the following sentence. Joe is very down to earth. This means that Joe is',
                'a' => 'a good farmer',
                'b' => 'rather short',
                'c' => 'practical and sensible',
                'd' => 'rough and dirty',
                'answer' => 'C'
            ]
            ,


            [
                'type' => 'stage3',
                'question' => 'Complete this sentence by choosing the option that most suitably fills the space; He went abroad with a view .... a business partner',
                'a' => 'to find',
                'b' => 'to be finding',
                'c' => 'to have found',
                'd' => 'to finding',
                'answer' => 'd'
            ],
            [
                'type' => 'stage3',
                'question' => 'The locus of a point which moves with a constant distance from a line |PQ| is a:',
                'a' => 'circle',
                'b' => 'perpendicular line',
                'c' => 'parallel line',
                'd' => 'point',
                'answer' => 'c'
            ],
            [
                'type' => 'stage3',
                'question' => 'Complete this sentence by choosing the option that most suitably fills the space; His suggestion are completely .... the point and cannot be accepted',
                'a' => 'beside',
                'b' => 'under',
                'c' => 'about',
                'd' => 'to',
                'answer' => 'a'
            ],
            [
                'type' => 'stage3',
                'question' => 'If (x + 3)<sup>2</sup> = 225,</br>which of the following could be the value of x - 1?',
                'a' => '13',
                'b' => '12',
                'c' => '-16',
                'd' => '-19',
                'answer' => 'd'
            ],
            [
                'type' => 'stage3',
                'question' => 'Complete this sentence by choosing the option that most suitably fills the space; Now that Michael has become rich, Nancy has begun to make much of him. This means that Nancy __________',
                'a' => 'now values Michael',
                'b' => 'now gets a lot of money from Michael',
                'c' => 'only recently married Michael',
                'd' => 'no longer wants to leave Michael',
                'answer' => 'a'
            ],
            [
                'type' => 'stage3',
                'question' => 'Evaluate (101.5)<sup>2</sup> - (100.5)<sup>2</sup>',
                'a' => '1',
                'b' => '20.02',
                'c' => '202',
                'd' => '2020',
                'answer' => 'c'
            ],
            [
                'type' => 'stage3',
                'question' => 'Choose the option that best conveys the meaning of the underlined portion in the following sentence; There is some obvious <u>symmetry</u> in the whole presentation',
                'a' => 'confusion',
                'b' => 'excitement',
                'c' => 'orderliness',
                'd' => 'dissatisfaction',
                'answer' => 'c'
            ],
            [
                'type' => 'stage3',
                'question' => 'Find the 8th term of the A.P -3, -1, 1 ......',
                'a' => '13',
                'b' => '11',
                'c' => '-8',
                'd' => '-11',
                'answer' => 'b'
            ],
            [
                'type' => 'stage3',
                'question' => 'In the question below choose the option nearest in meaning to the word underlined: If your life is in <u>turmoil</u>, always take courage',
                'a' => 'devastation',
                'b' => 'crisis',
                'c' => 'trial',
                'd' => 'tragedy',
                'answer' => 'b'
            ],
            [
                'type' => 'stage3',
                'question' => 'If the hypotenuse of an isosceles right triangle is 10, what is the area of the triangle?',
                'a' => '2.5',
                'b' => '25',
                'c' => '50',
                'd' => '100',
                'answer' => 'b'
            ]

        ];

        foreach ($data as $entry) {
            DB::table('questions')->insert([
                'question' => $entry['question'],
                'a' => $entry['a'],
                'b' => $entry['b'],
                'c' => $entry['c'],
                'd' => $entry['d'],
                'e' => $entry['e'] ?? null,
                'answer' => $entry['answer'],
                'class' => 'all',
                'type' => $entry['type'],
                'meta' => json_encode([]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
};
