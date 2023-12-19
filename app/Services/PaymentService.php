<?php

declare(strict_types=1);

namespace App\Services;

use App\DataTransferObjects\GatewayOneDTO;
use App\DataTransferObjects\GatewayTwoDTO;
use App\Models\Payment;
use Throwable;

/**
 * Class PaymentService.
 */
final class PaymentService
{
    /**
     * @param GatewayOneDTO $dto
     * @return Payment|null
     */
    public function processPaymentGatewayOne(GatewayOneDTO $dto): ?Payment
    {
        try {
            return Payment::updateOrCreate(
                [
                    'payment_id' => $dto->payment_id,
                    'gateway' => 'GatewayOne'
                ],
                [
                    'status' => $dto->status,
                    'amount' => $dto->amount,
                    'amount_paid' => $dto->amount_paid,
                    'timestamp' => $dto->timestamp,
                    'additional_info' => json_encode($dto->toArray())
                ]
            );
        } catch (Throwable $exception) {
            //Log here
        }
        return null;
    }

    /**
     * Process a payment from Gateway Two.
     *
     * @param GatewayTwoDTO $dto
     * @return Payment|null
     */
    public function processPaymentGatewayTwo(GatewayTwoDTO $dto): ?Payment
    {
        try {
            return Payment::updateOrCreate(
                [
                    'payment_id' => $dto->invoice,
                    'gateway' => 'GatewayTwo'
                ],
                [
                    'status' => $dto->status,
                    'amount' => $dto->amount,
                    'amount_paid' => $dto->amount_paid,
                    'timestamp' => time(),
                    'additional_info' => json_encode($dto->toArray())
                ]
            );
        } catch (Throwable $exception) {
            //Log here
        }
        return null;
    }
}
