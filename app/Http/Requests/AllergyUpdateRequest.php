<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AllergyUpdateRequest extends FormRequest
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
            'name' => ['string', 'max:255'],
            'type' => ['string', 'max:255'],
            'reaction' => ['string', 'max:255'],
            'status' => ['required', 'string'],
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'patient_visit_id' => ['required', 'integer', 'exists:patient_visits,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'created_by_id' => ['required', 'integer', 'exists:created_bies,id'],
            'updated_by_id' => ['required', 'integer', 'exists:updated_bies,id'],
        ];
    }
}
