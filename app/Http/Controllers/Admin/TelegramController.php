<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\TelegramUser;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Api;

class TelegramController extends Controller
{

public function webhook() {
        $telegram = new Api('2112813094:AAFLMlGU0YKNGGUMbi4uDlTBOkVJ9oqFaT4');

        if(isset($telegram->getWebhookUpdates()['message'])) {
        $updates = $telegram->getWebhookUpdates()['message'];
        if(!TelegramUser::find($updates['from']['id'])) {

                $product = new TelegramUser();

                $product->id = $updates['from']['id'];

                if(isset($updates['from']['is_bot'])) {
                    $product->is_bot = $updates['from']['is_bot'];
                }

                if(isset($updates['from']['first_name'])) {
                    $product->first_name = $updates['from']['first_name'];
                }
                if(isset($updates['from']['last_name'])) {
                    $product->last_name = $updates['from']['last_name'];
                }
                if(isset($updates['from']['username'])) {
                    $product->username = $updates['from']['username'];
                }
                if(isset($updates['from']['language_code'])) {
                    $product->language_code = $updates['from']['language_code'];
                }

                if($updates["text"] == "Осень" or $updates["text"] == "Зима" or $updates["text"] == "Весна" or $updates["text"] == "Лето") {
                $product->year = $updates["text"];
                 }

                $product->save();
        } else {
            if($updates["text"] == "Осень" or $updates["text"] == "Зима" or $updates["text"] == "Весна" or $updates["text"] == "Лето") {
                TelegramUser::where("id", $updates['from']['id'])->update(["year" => $updates["text"]]);
            }
        }
            Telegram::commandsHandler(true);
        }
}
}
