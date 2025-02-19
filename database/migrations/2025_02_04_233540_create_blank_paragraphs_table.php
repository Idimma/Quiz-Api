<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('blank_paragraphs');
        Schema::create('blank_paragraphs', function (Blueprint $table) {
            $table->id();
            $table->longText('question')->nullable();
            $table->longText('answer')->nullable();
            $table->string('level')->nullable();
            $table->string('type')->nullable();
            $table->text('meta')->nullable();
            $table->text('student_instruction')->nullable();
            $table->longText('ai_instruction')->nullable();
            $table->timestamps();
        });

        DB::table('blank_paragraphs')->insert([
            [
                'question' => 'Who watched as Moses floated in the basket down the Nile?',
                'answer' => 'His Sister Miriam',
                'level' => 'level1',
                'type' => 'bible',
                'meta' => '{"bible_ref": "Exodus 2:4"}',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Who would have nothing to do with the author of 3 John?',
                'answer' => 'Diotrephes',
                'level' => 'level1',
                'type' => 'bible',
                'meta' => '{"bible_ref": "3 John 1:9"}',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => "In the book of Philemon, who is Paul's fellow prisoner?",
                'answer' => 'Epaphras',
                'level' => 'level1',
                'type' => 'bible',
                'meta' => '{"bible_ref": "Philemon 1:23"}',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'James used the example of which Old Testament figure to demonstrate how the prayers of a righteous man can have powerful results?',
                'answer' => 'Elijah',
                'level' => 'level1',
                'type' => 'bible',
                'meta' => '{"bible_ref": "James 5:13-18"}',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'How does the author of 1 John often refer to his readers?',
                'answer' => 'Children',
                'level' => 'level1',
                'type' => 'bible',
                'meta' => '{"bible_ref": "1 John 1"}',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'What does Solomon say about sin?',
                'answer' => 'That no one does not sin',
                'level' => 'level1',
                'type' => 'bible',
                'meta' => '{"bible_ref": "Ecclesiastes 7:20"}',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Who pretended to be mad to avoid capture and death at the hands of an enemy king?',
                'answer' => 'David',
                'level' => 'level1',
                'type' => 'bible',
                'meta' => '{"bible_ref": "1 Samuel 21:13"}',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Who was the priest of Bethel during the time of Amos?',
                'answer' => 'Amaziah',
                'level' => 'level1',
                'type' => 'bible',
                'meta' => '{"bible_ref": "Amos 7:10"}',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Who was the grandson of Samuel?',
                'answer' => 'Heman',
                'level' => 'level1',
                'type' => 'bible',
                'meta' => '{"bible_ref": "1 Chronicles 6:33"}',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Who was the high priest during the time of Zechariah?',
                'answer' => 'Joshua',
                'level' => 'level1',
                'type' => 'bible',
                'meta' => '{"bible_ref": "Zechariah 6:10-11"}',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'What does John 3:16 say about God\'s love for the world?',
                'answer' => 'John 3:16, one of the most well-known verses in the Bible, expresses the depth of God\'s love for the world. It states, "For God so loved the world, that He gave His only Son, that whoever believes in Him should not perish but have eternal life." This verse highlights the unconditional love of God, who sacrificed His only Son, Jesus Christ, for the salvation of humanity. The message underscores the importance of belief in Jesus as the key to receiving eternal life. This act of love is not just for a select group, but for the entire world, offering a pathway to salvation to anyone who accepts it. This verse emphasizes the theme of redemption and eternal life, central to Christian faith.',
                'level' => 'Beginner',
                'type' => 'Theological',
                'meta' => '{"bible_ref": "John 3:16"}',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'What is the significance of the "Fruit of the Spirit" in Galatians 5:22-23?',
                'answer' => 'Galatians 5:22-23 outlines the "Fruit of the Spirit," a set of virtues that are manifestations of the Holy Spirit’s presence in a believer’s life. These qualities include love, joy, peace, forbearance, kindness, goodness, faithfulness, gentleness, and self-control. These virtues are considered the evidence of a Christian living in accordance with the Holy Spirit. The passage teaches that as Christians grow in their faith, they should exhibit these traits in their daily lives, showing the transformative power of the Spirit within them. These virtues not only enhance personal character but also build stronger relationships with others, promoting peace and unity within the community. Unlike the works of the flesh, which lead to division and sin, the Fruit of the Spirit is a sign of spiritual maturity and divine influence.',
                'level' => 'level1',
                'type' => 'bible',
                'meta' => '{"bible_ref": "Galatians 5:22-23"}',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'What does Psalm 23 say about the Lord as our Shepherd?',
                'answer' => 'Psalm 23, attributed to King David, describes the Lord as the Shepherd who provides for and protects His people. It begins with the verse, "The Lord is my shepherd; I shall not want." This verse emphasizes the trusting relationship between God and His people, highlighting His care and provision. Throughout the psalm, the imagery of the shepherd is used to show how God leads, guides, and comforts His followers, even in the darkest times. The Lord, as our Shepherd, offers peace, protection, and security. The psalm emphasizes that, no matter the circumstances, God is always present to guide His people through life’s challenges.',
                'level' => 'level1',
                'type' => 'bible',
                'meta' => '{"bible_ref": "Psalm 23"}',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blank_paragraphs');
    }
};
