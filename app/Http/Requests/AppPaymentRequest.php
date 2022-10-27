<?php

namespace App\Http\Requests;

use App\Enums\MerchantAppPaymentStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class AppPaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'project'      => ['required', 'numeric', 'max:99999999999999'],
            'amount_paid' => ['required', 'numeric', 'max:9999999999999999'],
            'currency'    => ['required', 'string', 'max:255'],
            'status'      => ['required', 'string', 'max:255', new Enum(MerchantAppPaymentStatus::class)],
        ];
    }
}
