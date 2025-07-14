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
//        $fios = $request->input('fio', []);
//        $emails = $request->input('email', []);
//        $telegrams = $request->input('telegram', []);
//        $phones = $request->input('phone', []);
//
//        $people = [];
//        $count = count($fios); // Предполагаем, что длины одинаковы
//
//        for ($i = 0; $i < $count; $i++) {
//            $people[] = [
//                'fio' => $fios[$i] ?? '',
//                'email' => $emails[$i] ?? '',
//                'telegram' => $telegrams[$i] ?? '',
//                'phone' => $phones[$i] ?? null, // Только у первого
//            ];
//        }

        // Валидация (упрощённо)
        $request->validate([
            'city' => 'required|string',
            'org' => 'required|string',
            'brand' => 'required|string',
            'people' => 'required|array|min:1', // массив пользователей
            'people.*.fio' => 'required|string',
            'people.*.email' => 'required|email',
            'people.*.telegram' => 'nullable|string',
            'people.0.phone' => 'required|string',
            'tariff_id' => 'required|string', // ID тарифа из формы (значение из списка)
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

        $countPeople = count($peopleNames);
        $discount = ($countPeople > 1) ? 5000 : 0;

        // Маппинг тарифов (значение из списка -> ID товара в каталоге)
        $tariffMap = [
            '14' => 14, // пример: тариф 1 -> ID товара 101
            '18' => 18, // тариф 2 -> ID товара 102
        ];

        $productId = $tariffMap[$request->input('tariff_id')] ?? null;

        if (!$productId) {
            return response()->json(['error' => 'Неверный тариф'], 400);
        }

        // Создаём сделку
        $dealFields = [
            'TITLE' => 'Заявка с сайта — ' . $request->input('org'),
            'CATEGORY_ID' => 12,
            'UF_CRM_1752325365' => $request->input('city'),
            'UF_CRM_1752325395' => $request->input('org'),
            'UF_CRM_1738082309' => $request->input('brand'),
            'UF_CRM_1752325711' => $peopleNames,
            'UF_CRM_1752325727' => $peopleEmails,
            'UF_CRM_1752325750' => $peopleTelegram,
            'UF_CRM_1752325761' => $request->input('people.0.phone'),
            'UF_CRM_1752326131' => $request->input('tariff_id'),
            'UF_CRM_1752325426' => $countPeople,
            'UF_CRM_1752326205' => $discount,
            'STAGE_ID' => 'NEW', // начальный этап сделки, замените если нужно
        ];

        $dealId = $this->createDeal($dealFields);

        if (!$dealId) {
            return response()->json(['error' => 'Ошибка создания сделки'], 500);
        }

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
            18 => 24000,
            14 => 28000,
            22 => 0,    // товар "Скидка"
        ];

        return $prices[$productId] ?? 0;
    }
}
