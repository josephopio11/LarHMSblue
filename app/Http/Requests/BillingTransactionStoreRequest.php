<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillingTransactionStoreRequest extends FormRequest
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
            'payment_amount' => ['required', 'integer'],
            'payment_mode' => ['string', 'max:255'],
            'status' => ['required', 'string'],
            'patient_visit_id' => ['required', 'integer', 'exists:patient_visits,id'],
            'billing_invoice_id' => ['required', 'integer', 'exists:billing_invoices,id'],
            'created_by_id' => ['required', 'integer', 'exists:created_bies,id'],
            'updated_by_id' => ['required', 'integer', 'exists:updated_bies,id'],
        ];
    }
}
