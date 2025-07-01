<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BitrixFormController extends Controller
{
    public function send(Request $request)
    {
        $webhook = env('BITRIX_WEBHOOK_URL'); // crm.lead.add endpoint

        $formType = $request->input('form_type');
        $formName = $request->input('form_name');

        // Общие поля
        $fields = [
            'TITLE' => 'Заявка с сайта (' . $formName . ')',
            'NAME' => $request->input('fio'),
            'PHONE' => [['VALUE' => $request->input('phone'), 'VALUE_TYPE' => 'WORK']],
            'EMAIL' => [['VALUE' => $request->input('email'), 'VALUE_TYPE' => 'WORK']],
        ];

        // Добавляем дополнительные поля по форме
        switch ($formType) {
            case 'form1':
                $fields['COMMENTS'] =
                    "Способ связи: " . $request->input('contact_method') . "\n" .
                    "Telegram: " . $request->input('telegram') . "\n" .
                    "Сообщение: " . $request->input('message');
                break;

            case 'form3':
                $fields['COMMENTS'] =
                    "Город: " . $request->input('city') . "\n" .
                    "Организация: " . $request->input('org') . "\n" .
                    "Бренд: " . $request->input('brand') . "\n" .
                    "Telegram: " . $request->input('telegram') . "\n" .
                    "Участник 2: " . $request->input('fio2') . ", " .
                    $request->input('telegram2') . ", " .
                    $request->input('email2');
                break;

            case 'form2':
                $fields['COMMENTS'] =
                    "Организация: " . $request->input('org');
                break;
        }
dump($webhook);
        $response = Http::post($webhook, ['fields' => $fields]);

        return response()->json(['success' => $response->successful()]);
    }
}
