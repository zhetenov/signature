<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

/**
 * Class GatewayOneDTO.
 */
final class GatewayOneDTO
{
    public int $payment_id;
    public string $status;
    public int $amount;
    public ?int $amount_paid;
    public int $timestamp;
    public string $sign;

    /**
     * @param array $data
     * @return static
     */
    public static function createFromArray(array $data): self
    {
        $dto = new self();
        $dto->payment_id = $data['payment_id'];
        $dto->status = $data['status'];
        $dto->amount = $data['amount'];
        $dto->amount_paid = $data['amount_paid'] ?? null;
        $dto->timestamp = $data['timestamp'];
        $dto->sign = $data['sign'];

        return $dto;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'payment_id'    => $this->payment_id,
            'status'        => $this->status,
            'amount'        => $this->amount,
            'amount_paid'   => $this->amount_paid,
            'timestamp'     => $this->timestamp,
            'sign'          => $this->sign,
        ];
    }
}
