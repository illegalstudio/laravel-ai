<?php

namespace Illegal\LaravelAI\Commands;

use Illuminate\Console\Command;
use OpenAI;

class InteractCommand extends Command
{
    /**
     * @var string The signature of the console command.
     */
    protected $signature = 'ai:interact {prompt : The prompt to interact with AI}';

    /**
     * @var string The description of the console command.
     */
    protected $description = 'Interact with AI';


    public function handle(): void
    {
        $this->info('Interact with AI');

        $yourApiKey = env('AI_OPENAI_API_KEY');
        $client = OpenAI::client($yourApiKey);

        $result = $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => $this->argument('prompt'),
            'max_tokens' => 100,
        ]);

        $text = "";
        foreach ($result['choices'] as $choice) {
            $text .= $choice['text'];
        }

        $this->info($this->argument('prompt') . $text );
    }

}
