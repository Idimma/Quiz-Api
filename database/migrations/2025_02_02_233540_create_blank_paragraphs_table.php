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
            $table->timestamps();
        });

        DB::table('blank_paragraphs')->insert([
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
                'level' => 'Intermediate',
                'type' => 'Theological',
                'meta' => '{"bible_ref": "Galatians 5:22-23"}',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'What does Psalm 23 say about the Lord as our Shepherd?',
                'answer' => 'Psalm 23, attributed to King David, describes the Lord as the Shepherd who provides for and protects His people. It begins with the verse, "The Lord is my shepherd; I shall not want." This verse emphasizes the trusting relationship between God and His people, highlighting His care and provision. Throughout the psalm, the imagery of the shepherd is used to show how God leads, guides, and comforts His followers, even in the darkest times. The Lord, as our Shepherd, offers peace, protection, and security. The psalm emphasizes that, no matter the circumstances, God is always present to guide His people through life’s challenges.',
                'level' => 'Beginner',
                'type' => 'Devotional',
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
