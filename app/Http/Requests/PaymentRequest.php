<?php

namespace App\Http\Requests;

use App\Enums\MerchantPaymentStatus;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

/**
 * @property int $merchant_id
 * @property int $payment_id
 * @property string $status
 * @property float $amount
 * @property float $amount_paid
 * @property string $currency
 * @property string $merchant_key
 * @property Carbon $timestamp
 */
class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'amount'      => ['required', 'numeric', 'max:99999999999999'],
            'amount_paid' => ['required', 'numeric', 'max:9999999999999999'],
            'currency'    => ['required', 'string', 'max:255'],
            'status'      => ['required', 'string', 'max:255', new Enum(MerchantPaymentStatus::class)],
        ];
    }
}
