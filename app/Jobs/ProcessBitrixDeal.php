<?php

namespace App\Jobs;

use App\Services\Bitrix24Service;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Exception;

class ProcessBitrixDeal implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $timeout = 60;
    public $backoff = [10, 30, 60];

    protected array $dealFields;
    protected array $products;

    public function __construct(array $dealFields, array $products)
    {
        $this->dealFields = $dealFields;
        $this->products = $products;
    }

    public function handle(Bitrix24Service $bitrixService): void
    {
        try {
            // Создание сделки
            $dealId = $bitrixService->createDeal($this->dealFields);

            if (!$dealId) {
                Log::error('Failed to create deal in Bitrix24 job', [
                    'fields' => $this->dealFields
                ]);
                $this->fail(new Exception('Failed to create deal'));
                return;
            }

            // Добавление товаров к сделке
            $success = $bitrixService->setDealProducts($dealId, $this->products);

            if (!$success) {
                Log::error('Failed to set deal products in Bitrix24 job', [
                    'deal_id' => $dealId,
                    'products' => $this->products
                ]);
                $this->fail(new Exception('Failed to set deal products'));
                return;
            }

            Log::info('Deal created successfully in Bitrix24 job', [
                'deal_id' => $dealId,
                'org' => $this->dealFields['UF_CRM_1752325395'] ?? 'Unknown'
            ]);

        } catch (Exception $e) {
            Log::error('Error in ProcessBitrixDeal job', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'deal_fields' => $this->dealFields
            ]);
            $this->fail($e);
        }
    }

    public function failed(Exception $exception): void
    {
        Log::error('ProcessBitrixDeal job failed', [
            'message' => $exception->getMessage(),
            'deal_fields' => $this->dealFields,
            'products' => $this->products
        ]);
    }
} 