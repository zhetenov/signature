<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Helpers\SignatureHelper;
use App\Http\Requests\GatewayOneRequest;
use App\Http\Requests\GatewayTwoRequest;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;

/**
 * Class PaymentController.
 */
final class PaymentController extends Controller
{
    protected PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * @param GatewayOneRequest $request
     * @return JsonResponse
     */
    public function handleGatewayOne(GatewayOneRequest $request): JsonResponse
    {
        $dto = $request->getDto();
        $calculatedSignature = SignatureHelper::calculateGatewayOneSignature($dto);
        if ($calculatedSignature !== $dto->sign) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }
        $payment = $this->paymentService->processPaymentGatewayOne($dto);
        if (is_null($payment)) {
            return response()->json(['message' => 'Payment error.'], 403);
        }
        return response()->json(['message' => 'Payment processed successfully.']);
    }

    /**
     * @param GatewayTwoRequest $request
     * @return JsonResponse
     */
    public function handleGatewayTwo(GatewayTwoRequest $request): JsonResponse
    {
        $dto = $request->getDto();
        $calculatedSignature = SignatureHelper::calculateGatewayTwoSignature($dto);
        $providedSignature = $request->header('Authorization');
        if ($calculatedSignature !== $providedSignature) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }
        $payment = $this->paymentService->processPaymentGatewayTwo($dto);
        if (is_null($payment)) {
            return response()->json(['message' => 'Payment error.'], 403);
        }
        return response()->json(['message' => 'Payment processed successfully.']);
    }
}
