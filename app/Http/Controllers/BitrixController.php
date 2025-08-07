<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class BitrixController extends Controller
{
    protected $bitrixDomain = 'https://zrenie1.bitrix24.ru';
    protected $webhook = 'wv49g0rovqdogsn8'; // Заменить на свой webhook

    public function submitForm(Request $request)
    {
        // Валидация (упрощённо)
        $request->validate([
            'city' => 'nullable|string',
            'org' => 'nullable|string',
            'brand' => 'nullable|string',
            'people' => 'required|array|min:1', // массив пользователей
            'people.*.fio' => 'required|string',
            'people.*.email' => 'nullable|email',
            'people.*.telegram' => 'nullable|string',
            'people.0.phone' => 'required|string',
            'contact_method' => 'nullable|string',
            'tariff_id' => 'nullable|string', // ID тарифа из формы (значение из списка)
            'message' => 'nullable|string',
            'form_name' => 'required|string',
            'agree' => 'accepted',
        ]);

        // Подготовка данных для сделки
        $peopleNames = [];
        $peopleEmails = [];
        $peopleTelegram = [];

        foreach ($request->input('people') as $person) {
            $peopleNames[] = $person['fio'];
            $peopleEmails[] = $person['email'];
            $peopleTelegram[] = $person['telegram'] ?? '';
        }

        $dealFields = [
            'CATEGORY_ID' => 12,
            'ASSIGNED_BY_ID' => 242,
            'UF_CRM_1752325711' => $peopleNames,
            'UF_CRM_1752325727' => $peopleEmails,
            'UF_CRM_1752325761' => $request->input('people.0.phone'),
            'OPENED' => 'Y',
            'STAGE_ID' => 'NEW', // начальный этап сделки, замените если нужно
        ];

        if ($request->input('form_name') == 1){
            $dealFields = array_merge($dealFields, [
                'TITLE' => 'Заявка с сайта — III Национальная конференция "Оптика Будущего", Форма "Стать спикером"',
                'COMMENTS' => "Метод для связи: " . $request->input('contact_method') . "\n Сообщение: " . $request->input('message'),
                'UF_CRM_1752325750' => $peopleTelegram,
            ]);
        }
        if ($request->input('form_name') == 2){
            $dealFields = array_merge($dealFields, [
                'TITLE' => 'Заявка с сайта — III Национальная конференция "Оптика Будущего", Форма "Стать партнером"',
                'UF_CRM_1752325395' => $request->input('org'),
            ]);
        }

        $countPeople = count($peopleNames);
        $discount = ($countPeople > 1) ? 5000 : 0;

        // Маппинг тарифов (значение из списка -> ID товара в каталоге)
        $tariffMap = [
            '14' => 14, // пример: тариф 1 -> ID товара 101
            '18' => 18, // тариф 2 -> ID товара 102
        ];

        $productId = $tariffMap[$request->input('tariff_id')] ?? null;

        if ($request->input('form_name') == 3){

            $dealFields = array_merge($dealFields, [
                'TITLE' => 'Заявка с сайта — III Национальная конференция "Оптика Будущего", Форма регистрании',
                'UF_CRM_1752325365' => $request->input('city'),
                'UF_CRM_1752325395' => $request->input('org'),
                'UF_CRM_1738082309' => $request->input('brand'),
                'UF_CRM_1752325750' => $peopleTelegram,
                'UF_CRM_1752325426' => $countPeople,
                'UF_CRM_1752326205' => $discount,
            ]);
        }

        $dealId = $this->createDeal($dealFields);

        if (!$dealId) {
            return response()->json(['error' => 'Ошибка создания сделки'], 500);
        }
        if ($request->input('form_name') == 3) {
            // Добавляем товары к сделке
            $products = [
                [
                    'PRODUCT_ID' => $productId,
                    'PRICE' => $this->getTariffPrice($productId),
                    'QUANTITY' => $countPeople,
                ]
            ];

            if ($discount > 0) {
                // Скидка как отдельный товар с отрицательной ценой
                $discountProductId = 22; // Создайте в каталоге товар "Скидка", ID здесь замените
                $products[] = [
                    'PRODUCT_ID' => $discountProductId,
                    'PRICE' => -5000,
                    'QUANTITY' => 1,
                ];
            }

            $success = $this->setDealProducts($dealId, $products);

            if (!$success) {
                return response()->json(['error' => 'Ошибка добавления товаров'], 500);
            }
        }

        return response()->json(['success' => true, 'deal_id' => $dealId]);
    }

    protected function createDeal(array $fields)
    {
        $client = new Client();

        $response = $client->post("{$this->bitrixDomain}/rest/1/{$this->webhook}/crm.deal.add.json", [
            'json' => ['fields' => $fields]
        ]);

        $result = json_decode($response->getBody(), true);
        return $result['result'] ?? null;
    }

    protected function setDealProducts($dealId, array $products)
    {
        $client = new Client();

        $response = $client->post("{$this->bitrixDomain}/rest/1/{$this->webhook}/crm.deal.productrows.set.json", [
            'json' => [
                'id' => $dealId,
                'rows' => $products
            ]
        ]);

        $result = json_decode($response->getBody(), true);
        return isset($result['result']) && $result['result'] === true;
    }

    protected function getTariffPrice($productId)
    {
        // Здесь лучше получать цену из Битрикс24 через API crm.product.get,
        // либо хранить в конфиге/базе
        $prices = [
            18 => 30000,
            14 => 35000,
            22 => 0,    // товар "Скидка"
        ];

        return $prices[$productId] ?? 0;
    }
}
