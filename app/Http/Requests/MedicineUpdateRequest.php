<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicineUpdateRequest extends FormRequest
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
            'medicine_code' => ['string', 'max:255'],
            'medicine_name' => ['string', 'max:255'],
            'medicine_price' => ['required', 'integer'],
            'medicine_profit' => ['required', 'integer'],
            'description' => ['string'],
            'available_quantity' => ['required', 'integer'],
            'alert_quantity' => ['required', 'integer'],
            'status' => ['required', 'string'],
            'purchase_id' => ['required', 'integer', 'exists:purchases,id'],
            'created_by_id' => ['required', 'integer', 'exists:created_bies,id'],
            'updated_by_id' => ['required', 'integer', 'exists:updated_bies,id'],
        ];
    }
}
