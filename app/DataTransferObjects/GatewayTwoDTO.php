<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

/**
 * Class GatewayTwoDTO.
 */
final class GatewayTwoDTO
{
    public int $project;
    public int $invoice;
    public string $status;
    public int $amount;
    public ?int $amount_paid;
    public string $rand;

    /**
     * @param array $data
     * @return static
     */
    public static function createFromArray(array $data): self
    {
        $dto = new self();
        $dto->project = $data['project'];
        $dto->invoice = $data['invoice'];
        $dto->status = $data['status'];
        $dto->amount = $data['amount'];
        $dto->amount_paid = $data['amount_paid'] ?? null;
        $dto->rand = $data['rand'];

        return $dto;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'project'       => $this->project,
            'invoice'       => $this->invoice,
            'status'        => $this->status,
            'amount'        => $this->amount,
            'amount_paid'   => $this->amount_paid,
            'rand'          => $this->rand,
        ];
    }
}
