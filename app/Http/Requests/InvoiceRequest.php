<?php

namespace App\Http\Requests;

use App\Enums\ProjectInvoiceStatus;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

/**
 * @property int $project
 * @property int $invoice
 * @property string $app_key
 * @property string $status
 * @property float $amount
 * @property float $amount_paid
 * @property string $currency
 * @property string $rand
 * @property Carbon $timestamp
 */
class InvoiceRequest extends FormRequest
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
            'project'     => ['required', 'numeric', 'max:99999999999999'],
            'invoice'     => ['required', 'numeric', 'max:99999999999999'],
            'amount_paid' => ['required', 'numeric', 'max:9999999999999999'],
            'amount'      => ['required', 'numeric', 'max:9999999999999999'],
            'currency'    => ['required', 'string', 'max:255'],
            'status'      => ['required', 'string', 'max:255', new Enum(ProjectInvoiceStatus::class)],
            'rand'        => ['required', 'string', 'max:255'],
        ];
    }
}
