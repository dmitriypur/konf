<?php

namespace App\Http\Controllers;

use App\Http\Requests\BitrixFormRequest;
use App\Jobs\ProcessBitrixDeal;
use App\Services\Bitrix24Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Exception;

class BitrixController extends Controller
{
    protected Bitrix24Service $bitrixService;

    public function __construct(Bitrix24Service $bitrixService)
    {
        $this->bitrixService = $bitrixService;
    }

    public function submitForm(BitrixFormRequest $request): JsonResponse
    {
        try {
            // Подготовка данных через сервис
            $dealData = $this->bitrixService->createDealFromForm($request->validated());

            // Проверяем, нужно ли использовать асинхронную обработку
            if (config('services.bitrix24.async', false)) {
                // Асинхронная обработка через Job
                ProcessBitrixDeal::dispatch($dealData['deal_fields'], $dealData['products']);
                
                Log::info('Bitrix24 deal job dispatched', [
                    'org' => $request->input('org'),
                    'count_people' => $dealData['count_people']
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Заявка принята и будет обработана в ближайшее время'
                ]);
            } else {
                // Синхронная обработка
                $dealId = $this->bitrixService->createDeal($dealData['deal_fields']);

                if (!$dealId) {
                    Log::error('Failed to create deal in Bitrix24', [
                        'fields' => $dealData['deal_fields']
                    ]);
                    return response()->json(['error' => 'Ошибка создания сделки'], 500);
                }

                // Добавление товаров к сделке
                $success = $this->bitrixService->setDealProducts($dealId, $dealData['products']);

                if (!$success) {
                    Log::error('Failed to set deal products in Bitrix24', [
                        'deal_id' => $dealId,
                        'products' => $dealData['products']
                    ]);
                    return response()->json(['error' => 'Ошибка добавления товаров'], 500);
                }

                Log::info('Deal created successfully in Bitrix24', [
                    'deal_id' => $dealId,
                    'org' => $request->input('org'),
                    'count_people' => $dealData['count_people']
                ]);

                return response()->json([
                    'success' => true, 
                    'deal_id' => $dealId,
                    'message' => 'Заявка успешно отправлена'
                ]);
            }

        } catch (Exception $e) {
            Log::error('Error in BitrixController::submitForm', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);

            return response()->json([
                'error' => 'Внутренняя ошибка сервера',
                'message' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}
