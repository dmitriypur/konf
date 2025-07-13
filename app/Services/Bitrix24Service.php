<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Exception;

class Bitrix24Service
{
    protected string $bitrixDomain;
    protected string $webhook;
    protected Client $httpClient;
    
    // Конфигурация тарифов
    protected array $tariffMap = [
        '14' => 14,
        '18' => 18,
    ];
    
    // Цены тарифов
    protected array $tariffPrices = [
        18 => 24000,
        14 => 28000,
        22 => 0, // товар "Скидка"
    ];
    
    // ID товара скидки
    protected int $discountProductId = 22;
    
    // Размер скидки
    protected int $discountAmount = 5000;

    public function __construct()
    {
        $this->bitrixDomain = config('services.bitrix24.domain');
        $this->webhook = config('services.bitrix24.webhook');
        $this->httpClient = new Client([
            'timeout' => config('services.bitrix24.timeout', 30),
            'connect_timeout' => config('services.bitrix24.connect_timeout', 10),
        ]);
    }

    public function createDealFromForm(array $formData): array
    {
        // Подготовка данных
        $peopleData = $this->preparePeopleData($formData['people']);
        $productId = $this->getProductId($formData['tariff_id']);
        $countPeople = count($peopleData['names']);
        $discount = $this->calculateDiscount($countPeople);

        // Создание сделки
        $dealFields = $this->prepareDealFields($formData, $peopleData, $countPeople, $discount);
        $products = $this->prepareProducts($productId, $countPeople, $discount);

        return [
            'deal_fields' => $dealFields,
            'products' => $products,
            'count_people' => $countPeople,
            'discount' => $discount
        ];
    }

    public function createDeal(array $fields): ?int
    {
        try {
            $response = $this->httpClient->post("{$this->bitrixDomain}/rest/1/{$this->webhook}/crm.deal.add.json", [
                'json' => ['fields' => $fields],
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ]
            ]);

            $result = json_decode($response->getBody(), true);
            
            if (isset($result['error'])) {
                Log::error('Bitrix24 API error in createDeal', [
                    'error' => $result['error'],
                    'fields' => $fields
                ]);
                return null;
            }

            return $result['result'] ?? null;

        } catch (GuzzleException $e) {
            Log::error('HTTP error in createDeal', [
                'message' => $e->getMessage(),
                'fields' => $fields
            ]);
            return null;
        }
    }

    public function setDealProducts(int $dealId, array $products): bool
    {
        try {
            $response = $this->httpClient->post("{$this->bitrixDomain}/rest/1/{$this->webhook}/crm.deal.productrows.set.json", [
                'json' => [
                    'id' => $dealId,
                    'rows' => $products
                ],
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ]
            ]);

            $result = json_decode($response->getBody(), true);
            
            if (isset($result['error'])) {
                Log::error('Bitrix24 API error in setDealProducts', [
                    'error' => $result['error'],
                    'deal_id' => $dealId,
                    'products' => $products
                ]);
                return false;
            }

            return isset($result['result']) && $result['result'] === true;

        } catch (GuzzleException $e) {
            Log::error('HTTP error in setDealProducts', [
                'message' => $e->getMessage(),
                'deal_id' => $dealId,
                'products' => $products
            ]);
            return false;
        }
    }

    public function getProductPrice(int $productId): int
    {
        return $this->tariffPrices[$productId] ?? 0;
    }

    public function getTariffMap(): array
    {
        return $this->tariffMap;
    }

    protected function preparePeopleData(array $people): array
    {
        $names = [];
        $emails = [];
        $telegram = [];

        foreach ($people as $person) {
            $names[] = trim($person['fio']);
            $emails[] = trim($person['email']);
            $telegram[] = trim($person['telegram'] ?? '');
        }

        return [
            'names' => $names,
            'emails' => $emails,
            'telegram' => $telegram
        ];
    }

    protected function getProductId(string $tariffId): int
    {
        return $this->tariffMap[$tariffId] ?? throw new Exception("Неверный тариф: {$tariffId}");
    }

    protected function calculateDiscount(int $countPeople): int
    {
        return ($countPeople > 1) ? $this->discountAmount : 0;
    }

    protected function prepareDealFields(array $formData, array $peopleData, int $countPeople, int $discount): array
    {
        return [
            'TITLE' => 'Заявка с сайта — ' . $formData['org'],
            'CATEGORY_ID' => 12,
            'UF_CRM_1752325365' => $formData['city'],
            'UF_CRM_1752325395' => $formData['org'],
            'UF_CRM_1738082309' => $formData['brand'],
            'UF_CRM_1752325711' => $peopleData['names'],
            'UF_CRM_1752325727' => $peopleData['emails'],
            'UF_CRM_1752325750' => $peopleData['telegram'],
            'UF_CRM_1752325761' => $formData['people'][0]['phone'],
            'UF_CRM_1752326131' => $formData['tariff_id'],
            'UF_CRM_1752325426' => $countPeople,
            'UF_CRM_1752326205' => $discount,
            'STAGE_ID' => 'NEW',
            'SOURCE_ID' => 'WEB',
            'COMMENTS' => 'Заявка с сайта конференции'
        ];
    }

    protected function prepareProducts(int $productId, int $countPeople, int $discount): array
    {
        $products = [
            [
                'PRODUCT_ID' => $productId,
                'PRICE' => $this->getProductPrice($productId),
                'QUANTITY' => $countPeople,
            ]
        ];

        if ($discount > 0) {
            $products[] = [
                'PRODUCT_ID' => $this->discountProductId,
                'PRICE' => -$discount,
                'QUANTITY' => 1,
            ];
        }

        return $products;
    }
}
