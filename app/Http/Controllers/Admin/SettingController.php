<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Api;
use Telegram\Bot\TelegramRequest;


class SettingController extends Controller
{
    public function index() {
        return view('result.index', Setting::getSettings());
    }

    public function store(Request $request) {
        Setting::where('key', '!=', NULL)->delete();

        foreach ($request->except('_token') as $key => $value) {
                $setting = new Setting;
                $setting->key = $key;
                $setting->value = $request->$key;
                $setting->save();
        }

        return redirect()->route('result.index')->with('status','Информация о url успешно обновлена.');
    }

public function setwebhook(Request $request) {
    $telegram = new Api('2112813094:AAFLMlGU0YKNGGUMbi4uDlTBOkVJ9oqFaT4');

$result = $this->sendTelegramData('setwebhook', [
    'query' => ['url' => $request->url . '/' . $telegram->getAccessToken()]
]);
    return redirect()->route('result.index')->with('status',$result);
}

public function getwebhookinfo(Request $request) {
        $result = $this->sendTelegramData('getWebhookInfo');
        return redirect()->route('result.index')->with('status',$result);
}


    public function sendTelegramData($route = '',$params=[],$method='POST') {
        $telegram = new Api('2112813094:AAFLMlGU0YKNGGUMbi4uDlTBOkVJ9oqFaT4');

        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.telegram.org/bot'. $telegram->getAccessToken() . '/']);
        $result = $client->request($method,$route,$params);
        return (string) $result->getBody();
    }
}
