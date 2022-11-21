<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientVisitUpdateRequest extends FormRequest
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
            'visit_no' => ['string', 'max:255'],
            'visit_type' => ['string', 'max:255'],
            'visit_date' => ['date'],
            'visit:status' => ['in:Admitted,Discharged,Pending'],
            'description' => ['string'],
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'created_by_id' => ['required', 'integer', 'exists:created_bies,id'],
            'updated_by_id' => ['required', 'integer', 'exists:updated_bies,id'],
        ];
    }
}
