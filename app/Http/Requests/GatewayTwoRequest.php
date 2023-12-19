<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\DataTransferObjects\GatewayTwoDTO;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class GatewayTwoRequest.
 */
final class GatewayTwoRequest extends FormRequest
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
            'project'       => 'required|integer',
            'invoice'       => 'required|integer',
            'status'        => 'required|string',
            'amount'        => 'required|integer',
            'amount_paid'   => 'nullable|integer',
            'rand'          => 'required|string',
        ];
    }

    /**
     * @return GatewayTwoDTO
     */
    public function getDto(): GatewayTwoDTO
    {
        return GatewayTwoDTO::createFromArray($this->validated());
    }
}
