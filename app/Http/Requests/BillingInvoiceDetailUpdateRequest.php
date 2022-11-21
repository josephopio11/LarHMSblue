<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillingInvoiceDetailUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'item_amount' => ['required', 'integer'],
            'item_total_amount' => ['required', 'integer'],
            'billing_invoice_id' => ['required', 'integer', 'exists:billing_invoices,id'],
            'created_by_id' => ['required', 'integer', 'exists:created_bies,id'],
            'updated_by_id' => ['required', 'integer', 'exists:updated_bies,id'],
        ];
    }
}
