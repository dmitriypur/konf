<?php

namespace App\Http\Controllers;

use App\Http\Requests\DealStoreRequest;
use App\Services\Bitrix24Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DealController extends Controller
{
    protected Bitrix24Service $bitrix;

    public function __construct(Bitrix24Service $bitrix)
    {
        $this->bitrix = $bitrix;
    }

    public function store(DealStoreRequest $request): JsonResponse
    {

        $validated = $request->validated();

        // Извлекаем участников
        $participants = $this->extractParticipants($validated);

        // Создаем или находим компанию
        $companyId = $this->processCompany($validated['org']);

        // Создаем или находим контакты
        $contactsIds = $this->processContacts($participants);

        // Подготавливаем продукты
        $products = $this->prepareProducts($participants);

        // Рассчитываем общую стоимость
        $totalCost = $this->calculateTotalCost($participants);

        // Создаем комментарий
        $comments = $this->generateComments($validated, $participants, $totalCost);

        // Создаем сделку
        $dealId = $this->createDeal(
            $validated,
            $companyId,
            $contactsIds,
            $totalCost,
            $comments
        );

        if (!$dealId) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при создании сделки'
            ], 500);
        }

        // Добавляем продукты к сделке
        $this->bitrix->setDealProducts($dealId, $products);

        return response()->json(['success' => true]);
    }

    protected function extractParticipants(array $data): array
    {
        $participants = [];

        foreach ($data as $key => $value) {
            if (preg_match('/^fio(\d+)$/', $key, $matches)) {
                $index = $matches[1];
                $participants[] = [
                    'fio' => $data["fio{$index}"] ?? '',
                    'phone' => $data["phone"] ?? '',
                    'telegram' => $data["telegram{$index}"] ?? '',
                    'email' => $data["email{$index}"] ?? '',
                ];
            }
        }

        return $participants;
    }

    protected function processCompany(string $organizationName): ?int
    {
        $companyId = $this->bitrix->findCompanyByName($organizationName);

        if (!$companyId) {
            $companyId = $this->bitrix->createCompany($organizationName);
        }

        return $companyId;
    }

    protected function processContacts(array $participants): array
    {
        $contactsIds = [];

        foreach ($participants as $participant) {
            $contactId = $this->bitrix->findContactByPhone($participant['phone']);

            if (!$contactId) {
                $contactId = $this->bitrix->createContact($participant);
            }

            if ($contactId) {
                $contactsIds[] = $contactId;
            }
        }

        return $contactsIds;
    }

    protected function prepareProducts(array $participants): array
    {
        $products = [];

        if (count($participants) == 1) {
            $products[] = [
                'PRODUCT_ID' => 2,
                'PRICE' => 24000,
                'QUANTITY' => 1,
            ];
        }

        if (count($participants) > 1) {
            $products[] = [
                'PRODUCT_ID' => 2,
                'PRICE' => $this->calculateTotalCost($participants),
                'QUANTITY' => count($participants) - 1,
                'DISCOUNT_TYPE_ID' => 1,
                'DISCOUNT_SUM' => 6000,
            ];
        }

        return $products;
    }

    protected function calculateTotalCost(array $participants): int
    {
        return 24000 * count($participants) - ((24000 * count($participants)) * 0.15);
    }

    protected function generateComments(array $data, array $participants, int $totalCost): string
    {
        $comments = "Организация: {$data['org']}\nГород: {$data['city']}\nКомпания (бренд): {$data['brand']}\nСтоимость: $totalCost\nУчастники:\n";

        foreach ($participants as $participant) {
            $comments .= "ФИО: {$participant['fio']}\nНомер телефона: {$participant['phone']}\nTelegram ID: {$participant['telegram']}\nEmail: {$participant['email']}\n\n";
        }

        return $comments;
    }

    protected function createDeal(
        array $data,
        ?int $companyId,
        array $contactsIds,
        int $totalCost,
        string $comments
    ): ?int {
        return $this->bitrix->createDeal([
            'TITLE' => 'Новая заявка с konf.future-optic.pro',
            'CATEGORY_ID' => 12,
            'ASSIGNED_BY_ID' => 242,
            'COMPANY_ID' => $companyId,
            'CONTACT_IDS' => $contactsIds,
            'OPPORTUNITY' => $totalCost,
            'OPENED' => 'Y',
            'COMMENTS' => $comments,
            'UF_CRM_1738082309' => $data['brand'],
        ]);
    }
}
