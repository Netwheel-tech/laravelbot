<?php

namespace App\Telegram;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Api;


/**
 * Class BotCommand.
 */
class BotCommand extends Command
{

 /**
     * @var string Command Name
     */
    protected $name = 'start';

    /**
     * @var string Command Description
     */
    protected $description = 'Начать опрос';

    /**
     * {@inheritdoc}
     */
    public function handle()
    {
        $commands = $this->telegram->getCommands();

        $text = '';

        foreach ($commands as $name => $handler) {
            /* @var Command $handler */
			$updates = $this->telegram->getWebhookUpdates()['message'];


            $keyboard = [
                ['Осень', 'Зима'],
                ['Лето', 'Весна']
            ];


            $reply_markup = [
                'keyboard' => $keyboard,
                'resize_keyboard' => true,
                'one_time_keyboard' => true
            ];

            $responce = $this->telegram->sendMessage([
                'chat_id' => $updates['from']['id'],
                'text' => 'Какое ваше время года любимое?',
                'reply_markup' => json_encode($reply_markup)
            ]);

        }

    }

}
