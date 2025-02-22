<?php

namespace App\Console\Commands;

use App\Question;
use Illuminate\Console\Command;

class EnterBibleQuestions extends Command
{
    protected $signature = 'load:questions';
    protected $description = 'Command description';

    public function handle()
    {
        error_reporting(E_ALL & ~E_DEPRECATED & ~E_DEPRECATED);
        $jsonData = file_get_contents(__DIR__ . '/questions.json');
        $newFormat = [];
        $questionData = json_decode($jsonData, true);
        if ($questionData === null) dd('Error decoding JSON');
        $level = 1;
        foreach ($questionData as $s => $_questions) {
            foreach ($_questions as $q) {
                $options = [
                    'a' => $q['opts'][0] ?? '',
                    'b' => $q['opts'][1] ?? '',
                    'c' => $q['opts'][2] ?? '',
                    'd' => $q['opts'][3] ?? ''
                ];
                $answerKey = array_search($q['answer'], $options, true);

                $qut = [
                    'type' => 'bible',
                    'question' => $q['question'],
                    'a' => $options['a'],
                    'b' => $options['b'],
                    'c' => $options['c'],
                    'd' => $options['d'],
                    'answer' => $answerKey,
                    'meta' => json_encode(['bible_ref' => trim($q['bible_ref'])]),
                    'class' => "level $level"
                ];
                $newFormat[] = $qut;
                Question::updateOrCreate($qut, $qut);
            }
            $level++;
        }

        return Command::SUCCESS;
    }
}
