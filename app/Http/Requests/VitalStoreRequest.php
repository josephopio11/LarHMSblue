<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VitalStoreRequest extends FormRequest
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
            'systolic_b_p' => ['required', 'integer'],
            'diastolic_b_p' => ['required', 'integer'],
            'temperature' => ['required', 'integer'],
            'weight' => ['required', 'integer'],
            'height' => ['required', 'integer'],
            'pulse' => ['required', 'integer'],
            'respiratory_rate' => ['required', 'integer'],
            'heart_rate' => ['required', 'integer'],
            'urine_output' => ['required', 'integer'],
            'blood_sugar_r' => ['required', 'integer'],
            'blood_sugar_f' => ['required', 'integer'],
            'spo_2' => ['required', 'integer'],
            'avpu' => ['string', 'max:255'],
            'trauma' => ['string', 'max:255'],
            'mobility' => ['string', 'max:255'],
            'oxygen_supplement' => ['string', 'max:255'],
            'comment' => ['string'],
            'status' => ['required', 'string'],
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'patient_visit_id' => ['required', 'integer', 'exists:patient_visits,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'created_by_id' => ['required', 'integer', 'exists:created_bies,id'],
            'updated_by_id' => ['required', 'integer', 'exists:updated_bies,id'],
        ];
    }
}
