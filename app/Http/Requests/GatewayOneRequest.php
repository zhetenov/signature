<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\DataTransferObjects\GatewayOneDTO;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class GatewayOneRequest.
 */
class GatewayOneRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'payment_id'    => 'required|integer',
            'status'        => 'required|string',
            'amount'        => 'required|integer',
            'amount_paid'   => 'nullable|integer',
            'timestamp'     => 'required|integer',
            'sign'          => 'required|string',
        ];
    }

    /**
     * @return GatewayOneDTO
     */
    public function getDto(): GatewayOneDTO
    {
        return GatewayOneDTO::createFromArray($this->validated());
    }
}
