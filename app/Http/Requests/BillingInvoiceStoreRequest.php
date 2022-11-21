<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillingInvoiceStoreRequest extends FormRequest
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
            'invoice_no' => ['string', 'max:255'],
            'total' => ['required', 'integer'],
            'pending_amount' => ['required', 'integer'],
            'paid_amount' => ['required', 'integer'],
            'mode' => ['required', 'string'],
            'discount_type' => ['string', 'max:255'],
            'discount_amount' => ['required', 'integer'],
            'discount_note' => ['string', 'max:255'],
            'note' => ['string'],
            'tax' => ['required', 'integer'],
            'additional_charge' => ['required', 'integer'],
            'status' => ['required', 'string'],
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'patient_visit_id' => ['required', 'integer', 'exists:patient_visits,id'],
            'doctor_order_id' => ['required', 'integer', 'exists:doctor_orders,id'],
            'created_by_id' => ['required', 'integer', 'exists:created_bies,id'],
            'updated_by_id' => ['required', 'integer', 'exists:updated_bies,id'],
        ];
    }
}
