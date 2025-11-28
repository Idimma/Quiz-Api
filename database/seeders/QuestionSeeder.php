<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $data = [
      [
        'type' => 'bible',
        'question' => 'The Lord Jesus confirmed His divinity in John 14:6–11 with different points. Mention and explain any ONE of the points in your own words, with the exact verse.',
        'a' => "He's the way, truth and life – John 14:6",
        'b' => "Whoever knows Jesus already knows God – John 14:7",
        'c' => "Whoever has seen Jesus has already seen God – John 14:9",
        'd' => "Jesus is in God and God is in Jesus – John 14:11",
        'answer' => 'A' // You can change this if a specific answer option is intended
      ],
      [
        'type' => 'bible',
        'question' => 'Which of the disciples asked Jesus, “Show us the Father” in John 14:6–11?',
        'a' => 'Thomas',
        'b' => 'Peter',
        'c' => 'Philip',
        'd' => 'Andrew',
        'answer' => 'C'
      ],
      [
        'type' => 'bible',
        'question' => 'Which extraordinary miracle performed by Jesus distinguishes Christianity from other religions?',
        'a' => 'He turned water to wine',
        'b' => 'He multiplied a meal',
        'c' => 'Christ Himself rose from the dead',
        'd' => 'He healed the blind',
        'answer' => 'C'
      ],
      [
        'type' => 'bible',
        'question' => 'Quote the popular Bible verse that connotes that the kingdom of God can only be accessed through Jesus Christ.',
        'a' => 'I am the resurrection and the life – John 11:25',
        'b' => 'I am the way, the truth, and the life – John 14:6',
        'c' => 'I am the bread of life – John 6:35',
        'd' => 'I am the good shepherd – John 10:11',
        'answer' => 'B'
      ],
      [
        'type' => 'bible',
        'question' => 'Define “miracle” according to the second lesson outline of Lesson 3 (The Deity of Jesus – Part 2).',
        'a' => 'An event caused by natural laws working unusually',
        'b' => 'An extraordinary occurrence that only God can perform, transcending natural laws',
        'c' => 'A surprising event caused by human ability',
        'd' => 'Any strange event without explanation',
        'answer' => 'B'
      ],
      [
        'type' => 'bible',
        'question' => 'What is forgiveness?',
        'a' => 'A natural reaction of anger toward someone who hurt you',
        'b' => 'An intentional decision to put aside resentment, anger, and revenge toward someone who wronged you',
        'c' => 'Forgetting a painful experience',
        'd' => 'Accepting that the offender was right',
        'answer' => 'B'
      ],
      
      [
        'type' => 'bible',
        'question' => 'Which of the following is a major reason why we are commanded to forgive? (Ephesians 4:32)',
        'a' => 'It brings wealth',
        'b' => 'It is a command',
        'c' => 'It increases intelligence',
        'd' => 'It improves social status',
        'answer' => 'B'
      ],
      
      [
        'type' => 'bible',
        'question' => 'According to Mark 11:35, why should we forgive?',
        'a' => 'Lack of forgiveness hinders prayers',
        'b' => 'Forgiveness increases friends',
        'c' => 'Forgiveness removes all problems',
        'd' => 'Forgiveness makes people fear you',
        'answer' => 'A'
      ],
      
      [
        'type' => 'bible',
        'question' => 'According to Matthew 5:14, why should we forgive?',
        'a' => 'We must maintain power over others',
        'b' => 'We are the light of the world and examples others follow',
        'c' => 'Forgiveness brings financial blessings',
        'd' => 'Forgiveness guarantees long life',
        'answer' => 'B'
      ],
      
      [
        'type' => 'bible',
        'question' => 'To forgive, we adopt a program known as what?',
        'a' => 'REFORM',
        'b' => 'RECALL',
        'c' => 'RESET',
        'd' => 'RENEW',
        'answer' => 'B'
      ],
      
      [
        'type' => 'bible',
        'question' => 'In the RECALL program, what does the letter R stand for?',
        'a' => 'Repent',
        'b' => 'Recall',
        'c' => 'Respond',
        'd' => 'Replace',
        'answer' => 'B'
      ],
      
      [
        'type' => 'bible',
        'question' => 'In the RECALL program, what does the letter E stand for?',
        'a' => 'Endure',
        'b' => 'Erase',
        'c' => 'Empathies',
        'd' => 'Encourage',
        'answer' => 'C'
      ],
      
      [
        'type' => 'bible',
        'question' => 'In the RECALL program, what does the letter A stand for?',
        'a' => 'Altruistic gift',
        'b' => 'Accept',
        'c' => 'Avoid',
        'd' => 'Admit',
        'answer' => 'A'
      ],
      
      [
        'type' => 'bible',
        'question' => 'According to the forgiveness program, at which stage does the offender remember their own shortcomings and realize forgiveness is a gift everyone needs?',
        'a' => 'Recall',
        'b' => 'Empathies',
        'c' => 'Commit',
        'd' => 'Altruistic gift',
        'answer' => 'D'
      ],
      
      [
        'type' => 'bible',
        'question' => 'Is it possible for one to need to forgive oneself?',
        'a' => 'Yes, because self-forgiveness is necessary for healing and growth',
        'b' => 'No, because forgiveness only applies to others',
        'c' => 'Yes, but only when instructed by others',
        'd' => 'No, because it is considered prideful',
        'answer' => 'A'
      ],
      [
        'type' => 'bible',
        'question' => '“Basileia” can be translated as all of the following EXCEPT __________.',
        'a' => 'Kingdom',
        'b' => 'Rule',
        'c' => 'Territory',
        'd' => 'Royalty',
        'answer' => 'C'
      ],
      [
        'type' => 'bible',
        'question' => 'In Matthew 6:33, seeking the Kingdom involves pursuing __________.',
        'a' => 'Spiritual gifts',
        'b' => 'Divine encounters',
        'c' => 'God’s righteousness',
        'd' => 'Personal holiness',
        'answer' => 'C'
      ],
      [
        'type' => 'bible',
        'question' => 'The Kingdom of God is also called the Kingdom of Heaven in __________.',
        'a' => 'Matthew 13:44',
        'b' => 'Matthew 19:23–24',
        'c' => 'Luke 17:20',
        'd' => 'John 3:3',
        'answer' => 'B'
      ],
      [
        'type' => 'bible',
        'question' => 'Which aspect of God’s kingdom involves His sovereign rule over all creation?',
        'a' => 'Mediatorial Kingdom',
        'b' => 'Spiritual Kingdom',
        'c' => 'Universal Kingdom',
        'd' => 'Eternal Kingdom',
        'answer' => 'C'
      ],
      [
        'type' => 'bible',
        'question' => 'Which kingdom uses human representatives in God’s dealings with His people?',
        'a' => 'Mediatorial Kingdom',
        'b' => 'Spiritual Kingdom',
        'c' => 'Universal Kingdom',
        'd' => 'Eternal Kingdom',
        'answer' => 'A'
      ],
      [
        'type' => 'bible',
        'question' => 'The Mediatorial Kingdom will end with __________.',
        'a' => 'The new heaven and new earth',
        'b' => 'The rapture',
        'c' => 'The millennial reign of Christ',
        'd' => 'The great tribulation',
        'answer' => 'C'
      ],
      [
        'type' => 'bible',
        'question' => 'The Spiritual Kingdom exists where?',
        'a' => 'In the unseen heavens',
        'b' => 'In the hearts of believers',
        'c' => 'In the church age',
        'd' => 'In the prophetic future',
        'answer' => 'B'
      ],
      [
        'type' => 'bible',
        'question' => 'The main benefit of entering the Kingdom is __________.',
        'a' => 'Access to spiritual gifts',
        'b' => 'Answers to prayers',
        'c' => 'Forgiveness of sins',
        'd' => 'Deliverance from enemies',
        'answer' => 'C'
      ],
      [
        'type' => 'bible',
        'question' => 'The Kingdom of God is equated with the “sphere of salvation” that must be entered through __________.',
        'a' => 'Repentance alone',
        'b' => 'Faith and repentance',
        'c' => 'Good works',
        'd' => 'Being born again',
        'answer' => 'D'
      ],
      [
        'type' => 'bible',
        'question' => 'The conclusion states that believers are commanded to __________.',
        'a' => 'Pray for the kingdom daily',
        'b' => 'Witness that the kingdom is open to all',
        'c' => 'Study the mysteries of the kingdom',
        'd' => 'Prepare for the end-time kingdom',
        'answer' => 'B'
      ],
      [
        'type' => 'bible',
        'question' => 'A________________ is a_____ or ________ in a polytheistic religion (belief in many gods).',
        'a' => 'Deity, god, goddess',
        'b' => 'Power, ability, strength',
        'c' => 'Devil, belief, showmanship',
        'd' => 'None of the above',
        'answer' => 'A'
      ],
      [
        'type' => 'bible',
        'question' => 'Is Jesus a member of the Godhead in the Trinity? What is He referred to as in Genesis 1:26a?',
        'a' => 'God the Father',
        'b' => 'God the Son',
        'c' => 'The Angel of the Lord',
        'd' => 'A prophet',
        'answer' => 'B'
      ],
      [
        'type' => 'bible',
        'question' => 'Old Testament prophecies of Christ announce His deity as ____________________.',
        'a' => 'Almighty God',
        'b' => 'Wonderful',
        'c' => 'Counsellor',
        'd' => 'Mighty God',
        'answer' => 'D'
      ],
      [
        'type' => 'bible',
        'question' => 'According to John 10:30, what does Jesus say in relation to His divinity?',
        'a' => 'I and the Father are one.',
        'b' => 'I am the good shepherd.',
        'c' => 'I am the bread of life.',
        'd' => 'I am the resurrection and the life.',
        'answer' => 'A'
      ],
      [
        'type' => 'bible',
        'question' => 'According to Matthew 2:11 and Luke 24:52, Jesus expects all believers to _____________ Him and never ____________ people.',
        'a' => 'Meditate, intercede',
        'b' => 'Probe, hit',
        'c' => 'Worship, rebuke',
        'd' => 'Follow, condemn',
        'answer' => 'C'
      ],
      [
        'type' => 'bible',
        'question' => 'Which of the following correctly lists apostles who testified that Jesus is God?',
        'a' => 'Moses, Elijah, Elisha',
        'b' => 'David, Solomon, Samuel',
        'c' => 'Thomas (John 20:28), Paul (Titus 2:13), Peter (2 Peter 1:1)',
        'd' => 'Job, Isaiah, Jeremiah',
        'answer' => 'C'
      ],
      [
        'type' => 'bible',
        'question' => 'What does 1 John 5:20 say?',
        'a' => 'The Lord is my shepherd, I shall not want.',
        'b' => 'In the beginning God created the heaven and the earth.',
        'c' => 'This is the true God and eternal life.',
        'd' => 'The kingdom of God is not meat and drink.',
        'answer' => 'C'
      ],
      [
        'type' => 'bible',
        'question' => 'The provision of salvation works how?',
        'a' => 'The blood of Jesus',
        'b' => 'If Jesus is God and He is the only way to salvation',
        'c' => 'The anointing',
        'd' => 'Through the prophets',
        'answer' => 'B'
      ],
      [
        'type' => 'bible',
        'question' => 'Who can forgive all sins?',
        'a' => 'Parents',
        'b' => 'The court',
        'c' => 'The peacemakers',
        'd' => 'Jesus',
        'answer' => 'D'
      ],
      [
        'type' => 'bible',
        'question' => 'Which attributes show Jesus as Creator according to the manual?',
        'a' => 'Ancient of Days, Lord of host, Merciful God',
        'b' => 'Miracle worker, All-sufficient God',
        'c' => 'Omnipotent, Omnipresent, Omniscient',
        'd' => 'Rapha, Elohim, Mekadishken',
        'answer' => 'C'
      ],
      [
        'type' => 'bible',
        'question' => 'What is the meaning of Redeemer?',
        'a' => 'Someone who teaches the law',
        'b' => 'Someone who comforts the weak',
        'c' => 'Jesus who came to save everyone from their sins',
        'd' => 'A prophet sent to warn the nations',
        'answer' => 'C'
      ],
      [
        'type' => 'bible',
        'question' => 'What does Colossians 1:16 say?',
        'a' => 'All things were created through Him and for Him.',
        'b' => 'He gives His angels charge over you.',
        'c' => 'He is the Alpha and Omega.',
        'd' => 'The joy of the Lord is your strength.',
        'answer' => 'A'
      ],
      [
        'type' => 'bible',
        'question' => 'Workplace ministry is also referred to as…………….',
        'a' => 'Marketplace Apostle',
        'b' => 'Marketplace service',
        'c' => 'Marketplace Ministry',
        'd' => 'Workplace Divine Service',
        'answer' => 'C'
      ],
      [
        'type' => 'bible',
        'question' => 'As Christians, God’s desire is for us to actively ………….. and uplift the world.',
        'a' => 'Inspire',
        'b' => 'Influence',
        'c' => 'Light',
        'd' => 'Salt',
        'answer' => 'B'
      ],
      [
        'type' => 'bible',
        'question' => 'Which of these is not one of the principles for ministering effectively in the workplace?',
        'a' => 'Alignment',
        'b' => 'Preparation',
        'c' => 'Intentionality',
        'd' => 'Connection',
        'answer' => 'B'
      ],
      [
        'type' => 'bible',
        'question' => 'According to the manual, Jesus calls us to influence others with……. ',
        'a' => 'Wisdom, Patience and Endurance',
        'b' => 'Wisdom, Patience and Hope',
        'c' => 'Wisdom, Compassion and Hope',
        'd' => 'Hope, Compassion and Endurance',
        'answer' => 'C'
      ],
      [
        'type' => 'bible',
        'question' => 'According to the manual, workplace ministry can transform lives and communities by addressing which of the following needs?',
        'a' => 'Physical, Mental and Spiritual needs',
        'b' => 'Physical, Spiritual and Emotional needs',
        'c' => 'Spiritual, Mental and Practical needs',
        'd' => 'Spiritual, Emotional and Practical needs',
        'answer' => 'D'
      ],
      [
        'type' => 'bible',
        'question' => 'Workplace Ministry is about living out the gospel with ……………………',
        'a' => 'Authenticity and Intentionality',
        'b' => 'Authenticity and Divinity',
        'c' => 'Intentionality and Divinity',
        'd' => 'Authenticity, Intentionality and Divinity',
        'answer' => 'A'
      ],
      [
        'type' => 'bible',
        'question' => 'According to the manual, our jobs are more than a means of income; they are opportunities to……………………',
        'a' => 'Support the work of God',
        'b' => 'Support the needy ones',
        'c' => 'Worship and serve God',
        'd' => 'Grow and expand',
        'answer' => 'C'
      ],
      [
        'type' => 'bible',
        'question' => 'Complete this Bible verse: “And whatever you do, do it ………….., as to the Lord and not to men”.',
        'a' => 'Heartily',
        'b' => 'Perfectly',
        'c' => 'Sincerely',
        'd' => 'Prayerfully',
        'answer' => 'A'
      ],
      [
        'type' => 'bible',
        'question' => 'WHAT IS THE TRANSLATION FOR HODOGEO PNEUMA?',
        'a' => 'LEADING OF THE HOLY SPIRIT',
        'b' => 'GUIDANCE OF THE BELIEVERS',
        'c' => 'WATER BAPTISM',
        'd' => 'GUIDANCE OF THE HOLY SPIRIT',
        'answer' => 'D'
      ],
      [
        'type' => 'bible',
        'question' => 'IN JOHN 16:13, WHO WAS SPEAKING AND WHO WAS BEING ADDRESSED?',
        'a' => 'PAUL, ADDRESSING THE APOSTLES OF THE COMING OF PEACE',
        'b' => 'JESUS CHRIST, ADDRESSING THE DISCIPLES ABOUT HIS ASCENSION',
        'c' => 'JESUS CHRIST, ADDRESSING THE JEWS',
        'd' => 'JESUS CHRIST, ADDRESSING THE DISCIPLES ABOUT THE COMING OF THE HOLY SPIRIT',
        'answer' => 'D'
      ],
      [
        'type' => 'bible',
        'question' => 'ONE OF THE FOLLOWING IS NOT A FUNCTION OF THE HOLY SPIRIT',
        'a' => 'REPROVES',
        'b' => 'CONDEMNS',
        'c' => 'TEACHES AND REMINDS',
        'd' => 'COMFORTS',
        'answer' => 'B'
      ],
      [
        'type' => 'bible',
        'question' => 'HOW DOES THE HOLY SPIRIT ACHIEVE GUIDANCE?',
        'a' => 'BY REVEALING GOD’S TRUTH',
        'b' => 'BY ASSURING US OF HIS PRESENCE',
        'c' => 'BY GIVING US CLARITY',
        'd' => 'ALL OF THE ABOVE',
        'answer' => 'D'
      ],
      [
        'type' => 'bible',
        'question' => 'THE HOLY SPIRIT GUIDES US BUT OUR OWN THOUGHTS ________.',
        'a' => 'CAN BE AFFECTED BY OUR FEELINGS AND DESIRES',
        'b' => 'ALWAYS BRING US PEACE',
        'c' => 'ARE ALWAYS RIGHT',
        'd' => 'IS NEVER MISLEADING',
        'answer' => 'A'
      ],
      [
        'type' => 'bible',
        'question' => 'WHAT IS THE MOST IMPORTANT WAY TO RECOGNISE THE HOLY SPIRIT’S GUIDANCE?',
        'a' => 'BY GOING TO CHURCH',
        'b' => 'BY OUR THOUGHTS',
        'c' => 'BY THE WORD',
        'd' => 'THROUGH OUR FRIENDS',
        'answer' => 'C'
      ],
      [
        'type' => 'bible',
        'question' => 'WHAT MEASURES CAN WE TAKE TO ALLOW THE HOLY SPIRIT DOMINATE OUR THOUGHTS?',
        'a' => 'BY CONTINUAL PRAYER',
        'b' => 'BY READING GOD’S WORD',
        'c' => 'BY NOT RESISTING THE WORK OF THE SPIRIT IN OUR LIVES',
        'd' => 'ALL OF THE ABOVE',
        'answer' => 'D'
      ],
      [
        'type' => 'bible',
        'question' => 'According to the introduction on faith and science; which is described as opposing forces?',
        'a' => 'Faith and tradition',
        'b' => 'Faith and science',
        'c' => 'Faith and justice',
        'd' => 'Faith and prophesy',
        'answer' => 'B'
      ],
      [
        'type' => 'bible',
        'question' => 'The two lesson outlines in the topic "Faith and Science" are:',
        'a' => 'Biblical basis & practical steps for engagement',
        'b' => 'The concept & The Harmony',
        'c' => 'Biblical views & Gods standard',
        'd' => 'Biblical forms & Scientific views',
        'answer' => 'B'
      ],
      [
        'type' => 'bible',
        'question' => 'Faith provides:',
        'a' => 'Moral guidance, love, hope',
        'b' => 'Hope, love, faith',
        'c' => 'Meaning, purpose, moral guidance',
        'd' => 'Moral guidance, strength, hope',
        'answer' => 'C'
      ],
      [
        'type' => 'bible',
        'question' => '“And He is before all things, and in Him all things consist”; where is this memory verse taken from?',
        'a' => 'Colossians 1:17',
        'b' => 'Hebrews 6:6',
        'c' => 'Colossians 3:7',
        'd' => 'Colossians 1:28',
        'answer' => 'A'
      ],
      [
        'type' => 'bible',
        'question' => 'Who, through keen observation of the natural world, explained botanical, zoological and aquatic phenomena?',
        'a' => 'Daniel',
        'b' => 'Noah',
        'c' => 'Ezra',
        'd' => 'Solomon',
        'answer' => 'D'
      ],
      [
        'type' => 'bible',
        'question' => 'Which of the following scientists was NOT described as a person of faith?',
        'a' => 'Isaac Newton',
        'b' => 'Gregor Mendel',
        'c' => 'Galileo Galilei',
        'd' => 'Marie Curie',
        'answer' => 'D'
      ],
      [
        'type' => 'bible',
        'question' => 'The discovery of the earth as spherical by science deepens the divine insight of which prophet?',
        'a' => 'Isaiah',
        'b' => 'Joel',
        'c' => 'Ezekiel',
        'd' => 'Hosea',
        'answer' => 'A'
      ],
      [
        'type' => 'bible',
        'question' => 'Why should our faith in God be absolute in this lesson?',
        'a' => 'He is the provider',
        'b' => 'He is the gracious one',
        'c' => 'He is the perfect creator',
        'd' => 'He is the King of Kings',
        'answer' => 'C'
      ],
      [
        'type' => 'bible',
        'question' => 'Science is useful in making discoveries of the truth of natural phenomena but prone to errors because:',
        'a' => 'It doesn’t have the hand of God in it',
        'b' => 'It depends on the limitation of mortal men',
        'c' => 'Humans are proud creatures',
        'd' => 'The laziness of men',
        'answer' => 'B'
      ],
      [
        'type' => 'bible',
        'question' => 'According to the conclusion, how can faith and science interact when approached with an open mind?',
        'a' => 'They complimentarily offer deeper insight into mysteries of existence and make life better',
        'b' => 'They should always be in conflict',
        'c' => 'Science must dominate faith in all matters',
        'd' => 'Faith must be placed above science at all times',
        'answer' => 'A'
      ],
      [
        'type' => 'bible',
        'question' => 'The introduction says prophecy is God ….',
        'a' => 'speaking to Pastors',
        'b' => 'sharing His mind and will',
        'c' => 'giving rules to follow',
        'd' => 'showing only future events',
        'answer' => 'B'
      ],
      [
        'type' => 'bible',
        'question' => 'The two main parts of the lesson are:',
        'a' => 'Old and New Testament',
        'b' => 'Understand Prophecy & The Benefits',
        'c' => 'Gifts and Tongues',
        'd' => 'Prayer and Fasting',
        'answer' => 'B'
      ],
      [
        'type' => 'bible',
        'question' => 'Prophecy gives believers:',
        'a' => 'money and success',
        'b' => 'guidance, encouragement, edification',
        'c' => 'power over others',
        'd' => 'long life only',
        'answer' => 'B'
      ],
      [
        'type' => 'bible',
        'question' => 'The memory verse “Pursue love… prophesy” is from:',
        'a' => '1 Corinthians 12:1',
        'b' => '1 Corinthians 14:1',
        'c' => 'Romans 12:6',
        'd' => 'Ephesians 4:11',
        'answer' => 'B'
      ],
      [
        'type' => 'bible',
        'question' => 'Who spoke to dry bones by God’s command?',
        'a' => 'Elijah',
        'b' => 'Moses',
        'c' => 'Ezekiel',
        'd' => 'David',
        'answer' => 'C'
      ],
      [
        'type' => 'bible',
        'question' => 'Which is NOT a form of prophecy listed?',
        'a' => 'Foretelling (future)',
        'b' => 'Forthtelling (now)',
        'c' => 'Discernment (hidden truth)',
        'd' => 'Singing hymns',
        'answer' => 'D'
      ],
      [
        'type' => 'bible',
        'question' => '“The testimony of Jesus” is called:',
        'a' => 'the spirit of prophecy',
        'b' => 'the gift of healing',
        'c' => 'the fruit of joy',
        'd' => 'the power of prayer',
        'answer' => 'A'
      ],
      [
        'type' => 'bible',
        'question' => 'We must test every prophecy with the Bible because:',
        'a' => 'Some are not from God',
        'b' => 'It makes us wiser',
        'c' => 'It gives more gifts',
        'd' => 'It stops all problems',
        'answer' => 'A'
      ],
      [
        'type' => 'bible',
        'question' => 'True prophecy comes from:',
        'a' => 'human ideas only',
        'b' => 'God’s inspiration',
        'c' => 'reading stars',
        'd' => 'dreams at night',
        'answer' => 'B'
      ],
      [
        'type' => 'bible',
        'question' => 'Prophecy helps the church by:',
        'a' => 'causing arguments',
        'b' => 'building up believers',
        'c' => 'replacing the pastor',
        'd' => 'predicting the weather',
        'answer' => 'B'
      ],
      [
        'type' => 'bible',
        'question' => 'The internal enemy is the ________________',
        'a' => 'Devil',
        'b' => 'Stronghold',
        'c' => 'Flesh',
        'd' => 'World',
        'answer' => 'C'
      ],
      [
        'type' => 'bible',
        'question' => 'Where can we see this verse "So then, those who are in the flesh cannot please God"?',
        'a' => 'Romans 8:8',
        'b' => 'Romans 8:9',
        'c' => 'Romans 9:8',
        'd' => 'Romans 7:8',
        'answer' => 'A'
      ],
      [
        'type' => 'bible',
        'question' => 'The flesh is not our body, but the sinful nature that dwells in our body.',
        'a' => 'True',
        'b' => 'False',
        'c' => 'Maybe',
        'answer' => 'A'
      ],
      [
        'type' => 'bible',
        'question' => 'Self pride is one of the ways self expresses itself in people.',
        'a' => 'Yes',
        'b' => 'No',
        'answer' => 'A'
      ],
      [
        'type' => 'bible',
        'question' => 'The external enemy is the ______________.',
        'a' => 'Flesh',
        'b' => 'World',
        'c' => 'Devil',
        'd' => 'Stronghold',
        'answer' => 'B'
      ],
      [
        'type' => 'bible',
        'question' => 'All but one is one of the ways self expresses itself in people.',
        'a' => 'Self love',
        'b' => 'Self pity',
        'c' => 'Self righteousness',
        'd' => 'Obedience',
        'answer' => 'D'
      ],
      [
        'type' => 'bible',
        'question' => 'We can be in control of flesh with the help of the __________________',
        'a' => 'Anointing',
        'b' => 'Praying in tongues',
        'c' => 'Holy Spirit',
        'd' => 'Devil',
        'answer' => 'C'
      ],
      [
        'type' => 'bible',
        'question' => 'One of the victories we have through God is _____________ except',
        'a' => 'He gave Christ to us as our new master.',
        'b' => 'He ended our old self life and created something new',
        'c' => 'He made us new person in Christ',
        'd' => 'He never chose to forgive us our sins.',
        'answer' => 'D'
      ]
    ];
    
    
    foreach ($data as $entry) {
      \DB::table('questions')->insert([
        'question' => $entry['question'],
        'a' => $entry['a'] ?? null,
        'b' => $entry['b'] ?? null,
        'c' => $entry['c'] ?? null,
        'd' => $entry['d'] ?? null,
        'e' => $entry['e'] ?? null,
        'answer' => $entry['answer'],
        'class' => 'all',
        'type' => $entry['type'] ?? 'bible',
        'meta' => json_encode([]),
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }
    
  }
}
