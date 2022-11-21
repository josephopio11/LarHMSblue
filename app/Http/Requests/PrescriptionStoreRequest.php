<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrescriptionStoreRequest extends FormRequest
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
            'dosage' => ['string', 'max:255'],
            'frequency' => ['string', 'max:255'],
            'duration' => ['string', 'max:255'],
            'food_relation' => ['string', 'max:255'],
            'route' => ['string', 'max:255'],
            'instruction' => ['string'],
            'status' => ['required', 'string'],
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'patient_visit_id' => ['required', 'integer', 'exists:patient_visits,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'medicine_id' => ['required', 'integer', 'exists:medicines,id'],
            'created_by_id' => ['required', 'integer', 'exists:created_bies,id'],
            'updated_by_id' => ['required', 'integer', 'exists:updated_bies,id'],
        ];
    }
}
