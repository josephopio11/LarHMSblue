<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BloodStockUpdateRequest extends FormRequest
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
            'blood_group' => ['string', 'max:255'],
            'blood_bank_id' => ['required', 'integer', 'exists:blood_banks,id'],
            'unit' => ['required', 'integer'],
            'status' => ['required', 'string'],
            'created_by_id' => ['required', 'integer', 'exists:created_bies,id'],
            'updated_by_id' => ['required', 'integer', 'exists:updated_bies,id'],
        ];
    }
}
