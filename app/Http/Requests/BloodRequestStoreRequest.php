<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BloodRequestStoreRequest extends FormRequest
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
            'reason' => ['string'],
            'blood_type' => ['string', 'max:255'],
            'unit' => ['required', 'integer'],
            'status' => ['required', 'string'],
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'created_by_id' => ['required', 'integer', 'exists:created_bies,id'],
            'updated_by_id' => ['required', 'integer', 'exists:updated_bies,id'],
        ];
    }
}
