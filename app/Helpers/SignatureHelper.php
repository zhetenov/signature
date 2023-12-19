<?php

declare(strict_types=1);

namespace App\Helpers;

use App\DataTransferObjects\GatewayOneDTO;
use App\DataTransferObjects\GatewayTwoDTO;

/**
 * Class SignatureHelper.
 */
final class SignatureHelper
{
    /**
     * @param GatewayOneDTO $dto
     * @return bool|string
     */
    public static function calculateGatewayOneSignature(GatewayOneDTO $dto): bool|string
    {
        $data = $dto->toArray();
        unset($data['sign']);
        ksort($data);
        $dataString = implode(':', $data);
        $merchantKey = env('GATEWAY_ONE_MERCHANT_KEY', 'test');
        $dataString .= ':' . $merchantKey;
        return hash('sha256', $dataString);
    }

    /**
     * @param GatewayTwoDTO $dto
     * @return string
     */
    public static function calculateGatewayTwoSignature(GatewayTwoDTO $dto): string
    {
        $data = $dto->toArray();
        unset($data['sign']);
        ksort($data);
        $dataString = implode('.', $data);
        $appKey = env('GATEWAY_TWO_APP_KEY', 'test');
        $dataString .= '.' . $appKey;
        return md5($dataString);
    }
}
