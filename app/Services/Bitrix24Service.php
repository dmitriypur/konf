<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Bitrix24Service
{
    protected string $webhookUrl;

    public function __construct()
    {
        $this->webhookUrl = config('services.bitrix.webhook_url');
    }

    public function makeRequest(string $method, array $params = [])
    {
        try {
            $response = Http::post($this->webhookUrl . $method, $params);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('Bitrix24 API error', [
                'method' => $method,
                'params' => $params,
                'response' => $response->body()
            ]);

            return null;

        } catch (\Exception $e) {
            Log::error('Bitrix24 API exception', [
                'method' => $method,
                'error' => $e->getMessage()
            ]);

            return null;
        }
    }

    public function findContactByPhone(string $phone)
    {
        $response = $this->makeRequest('crm.contact.list', [
            'filter' => ['PHONE' => $phone],
            'select' => ['ID']
        ]);

        return $response['result'][0]['ID'] ?? null;
    }

    public function createContact(array $data)
    {
        $response = $this->makeRequest('crm.contact.add', [
            'fields' => [
                'NAME' => $data['fio'],
                'PHONE' => [['VALUE' => $data['phone'], 'VALUE_TYPE' => 'WORK']],
                'EMAIL' => [['VALUE' => $data['email1'] ?? '', 'VALUE_TYPE' => 'WORK']],
            ],
            'params' => ['REGISTER_SONET_EVENT' => 'Y']
        ]);

        return $response['result'] ?? null;
    }

    public function findCompanyByName(string $name)
    {
        $response = $this->makeRequest('crm.company.list', [
            'filter' => ['TITLE' => $name],
            'select' => ['ID']
        ]);

        return $response['result'][0]['ID'] ?? null;
    }

    public function createCompany(string $name)
    {
        $response = $this->makeRequest('crm.company.add', [
            'fields' => ['TITLE' => $name],
            'params' => ['REGISTER_SONET_EVENT' => 'Y']
        ]);

        return $response['result'] ?? null;
    }

    public function createDeal(array $fields)
    {
        $response = $this->makeRequest('crm.deal.add', [
            'fields' => $fields,
            'params' => ['REGISTER_SONET_EVENT' => 'Y']
        ]);

        return $response['result'] ?? null;
    }

    public function setDealProducts($dealId, array $products)
    {
        return $this->makeRequest('crm.deal.productrows.set', [
            'id' => $dealId,
            'rows' => $products
        ]);
    }
}
