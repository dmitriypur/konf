<?php

namespace App\Http\Controllers;

//use App\Http\Requests\BitrixFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BitrixFormController extends Controller
{
    public function send(Request $request)
    {
        $webhook = config('services.bitrix.webhook_url');

        $webhook = $webhook . 'crm.deal.add';

        $formType = $request->input('form_type');
        $formName = $request->input('form_name');

        $fields = [
            'fields' => [
                'TITLE' => 'Новая заявка с konf.future-optic.pro ' . $formName,
                'NAME' => $request->input('fio'),
                'PHONE' => [['VALUE' => $request->input('phone'), 'VALUE_TYPE' => 'WORK']],
                'EMAIL' => [['VALUE' => $request->input('email'), 'VALUE_TYPE' => 'WORK']],
                'CATEGORY_ID' => 1,
                'ASSIGNED_BY_ID' => 242,
                'COMPANY_ID' => 'test',
                'CONTACT_IDS' => 'test 2',
                'OPPORTUNITY' => 2,
                'OPENED' => 'Y',
                'COMMENTS' => '$comments',
                'UF_CRM_1738082309' => '$brand',
            ],
            'params' => ['REGISTER_SONET_EVENT' => 'Y'],
        ];

        $response = Http::post($webhook, ['fields' => $fields]);

        return response()->json(['success' => $response->successful()]);
    }
}
